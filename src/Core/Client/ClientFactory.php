<?php

namespace Commercetools\Core\Client;

use Commercetools\Core\Cache\CacheAdapterFactory;
use Commercetools\Core\Client\OAuth\CacheTokenProvider;
use Commercetools\Core\Client\OAuth\ClientCredentials;
use Commercetools\Core\Client\OAuth\CredentialTokenProvider;
use Commercetools\Core\Client\OAuth\OAuth2Handler;
use Commercetools\Core\Client\OAuth\TokenProvider;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Error\DeprecatedException;
use Commercetools\Core\Error\InvalidTokenException;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\SimpleCache\CacheInterface;

class ClientFactory
{
    /**
     * @var bool
     */
    private static $isGuzzle6;

    /**
     * ClientFactory constructor.
     * @throws DeprecatedException
     */
    public function __construct()
    {
        if (!self::isGuzzle6()) {
            throw new DeprecatedException("ClientFactory doesn't support Guzzle version < 6");
        }
    }

    /**
     * @param string $clientClass
     * @param Config|array $config
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param TokenProvider $provider
     * @param CacheAdapterFactory $cacheAdapterFactory
     * @param Context|null $context
     * @return Client
     */
    public function createCustomClient(
        $clientClass,
        $config,
        LoggerInterface $logger = null,
        $cache = null,
        TokenProvider $provider = null,
        CacheAdapterFactory $cacheAdapterFactory = null,
        Context $context = null
    ) {
        $config = $this->createConfig($config);

        if (is_null($cacheAdapterFactory)) {
            $cacheDir = $config->getCacheDir();
            $cacheDir = !is_null($cacheDir) ? $cacheDir : realpath(__DIR__ . '/../../..');
            $cacheAdapterFactory = new CacheAdapterFactory($cacheDir);
        }

        $cache = $cacheAdapterFactory->get($cache);
        if (is_null($cache)) {
            throw new InvalidArgumentException(Message::INVALID_CACHE_ADAPTER);
        }

        $credentials = $config->getClientCredentials();
        $oauthHandler = $this->getHandler(
            $credentials,
            $config->getOauthUrl(),
            $cache,
            $provider,
            $config->getOAuthClientOptions()
        );

        $options = $this->getDefaultOptions($config);

        $client = $this->createGuzzle6Client($clientClass, $options, $oauthHandler, $logger, $config->getCorrelationIdProvider());

        if ($client instanceof ContextAwareInterface) {
            $client->setContext($context);
        }
        return $client;
    }

    /**
     * @param Config|array $config
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param TokenProvider $provider
     * @param CacheAdapterFactory $cacheAdapterFactory
     * @param Context|null $context
     * @return ApiClient
     */
    public function createClient(
        $config,
        LoggerInterface $logger = null,
        $cache = null,
        TokenProvider $provider = null,
        CacheAdapterFactory $cacheAdapterFactory = null,
        Context $context = null
    ) {
        return $this->createCustomClient(
            ApiClient::class,
            $config,
            $logger,
            $cache,
            $provider,
            $cacheAdapterFactory,
            $context
        );
    }

    private function getDefaultOptions(Config $config)
    {
        $options = $config->getClientOptions();
        $options['http_errors'] = $config->getThrowExceptions();
        $options['base_uri'] = $config->getApiUrl() . "/" . $config->getProject() . "/";
        $defaultHeaders = [
            'User-Agent' => (new UserAgentProvider())->getUserAgent()
        ];
        if (!is_null($config->getAcceptEncoding())) {
            $defaultHeaders['Accept-Encoding'] = $config->getAcceptEncoding();
        }
        $options['headers'] = array_merge($defaultHeaders, (isset($options['headers']) ? $options['headers'] : []));

        return $options;
    }

    /**
     * @param Config|array $config
     * @return Config
     * @throws InvalidArgumentException
     */
    private function createConfig($config)
    {
        if ($config instanceof Config) {
            return $config;
        }
        if (is_array($config)) {
            return Config::fromArray($config);
        }
        throw new InvalidArgumentException();
    }

    /**
     * @param string $clientClass
     * @param array $options
     * @param OAuth2Handler $oauthHandler
     * @param LoggerInterface|null $logger
     * @param CorrelationIdProvider|null $correlationIdProvider
     * @return Client
     */
    private function createGuzzle6Client(
        $clientClass,
        array $options,
        OAuth2Handler $oauthHandler,
        LoggerInterface $logger = null,
        CorrelationIdProvider $correlationIdProvider = null
    ) {
        if (isset($options['handler']) && $options['handler'] instanceof HandlerStack) {
            $handler = $options['handler'];
        } else {
            $handler = HandlerStack::create();
            $options['handler'] = $handler;
        }

        $options = array_merge(
            [
                'allow_redirects' => false,
                'verify' => true,
                'timeout' => 60,
                'connect_timeout' => 10,
                'pool_size' => 25,
            ],
            $options
        );

        if (!is_null($logger)) {
            $this->setLogger($handler, $logger);
        }

        $handler->remove("http_errors");
        $handler->unshift(self::httpErrors(), 'ctp_http_errors');

        $handler->push(
            Middleware::mapRequest($oauthHandler),
            'oauth_2_0'
        );
        if ($oauthHandler->refreshable()) {
            $handler->push(
                self::reauthenticate($oauthHandler),
                'reauthenticate'
            );
        }

        if (!is_null($correlationIdProvider)) {
            $handler->push(Middleware::mapRequest(function (RequestInterface $request) use ($correlationIdProvider) {
                return $request->withAddedHeader(
                    AbstractApiResponse::X_CORRELATION_ID,
                    $correlationIdProvider->getCorrelationId()
                );
            }), 'ctp_correlation_id');
        }

        $client = new $clientClass($options);

        return $client;
    }

    private function setLogger(
        HandlerStack $handler,
        LoggerInterface $logger,
        $logLevel = LogLevel::INFO,
        $formatter = null
    ) {
        if (is_null($formatter)) {
            $formatter = new MessageFormatter();
        }
        $handler->push(self::log($logger, $formatter, $logLevel), 'ctp_logger');
    }

    /**
     * Middleware that reauthenticates on invalid token error
     *
     * @param OAuth2Handler $oauthHandler
     * @param int $maxRetries
     * @return callable Returns a function that accepts the next handler.
     */
    public static function reauthenticate(OAuth2Handler $oauthHandler, $maxRetries = 1)
    {
        return function (callable $handler) use ($oauthHandler, $maxRetries) {
            return function (RequestInterface $request, array $options) use ($handler, $oauthHandler, $maxRetries) {
                return $handler($request, $options)->then(
                    function (ResponseInterface $response) use (
                        $request,
                        $handler,
                        $oauthHandler,
                        $options,
                        $maxRetries
                    ) {
                        if ($response->getStatusCode() == 401) {
                            if (!isset($options['reauth'])) {
                                $options['reauth'] = 0;
                            }
                            $exception = ApiException::create($request, $response);
                            if ($options['reauth'] < $maxRetries && $exception instanceof InvalidTokenException) {
                                $options['reauth']++;
                                $token = $oauthHandler->refreshToken();
                                $request = $request->withHeader(
                                    'Authorization',
                                    'Bearer ' . $token->getToken()
                                );
                                return $handler($request, $options);
                            }
                        }
                        return $response;
                    }
                );
            };
        };
    }

    /**
     * Middleware that throws exceptions for 4xx or 5xx responses when the
     * "http_error" request option is set to true.
     *
     * @return callable Returns a function that accepts the next handler.
     */
    public static function httpErrors()
    {
        return function (callable $handler) {
            return function ($request, array $options) use ($handler) {
                if (empty($options['http_errors'])) {
                    return $handler($request, $options);
                }
                return $handler($request, $options)->then(
                    function (ResponseInterface $response) use ($request, $handler) {
                        $code = $response->getStatusCode();
                        if ($code < 400) {
                            return $response;
                        }
                        throw ApiException::create($request, $response);
                    }
                );
            };
        };
    }

    /**
     * @param ClientCredentials $credentials
     * @param string $accessTokenUrl
     * @param CacheItemPoolInterface|CacheInterface $cache
     * @param TokenProvider $provider
     * @param array $authClientOptions
     * @return OAuth2Handler
     */
    private function getHandler(
        ClientCredentials $credentials,
        $accessTokenUrl,
        $cache,
        TokenProvider $provider = null,
        array $authClientOptions = []
    ) {
        if (is_null($provider)) {
            $provider = new CredentialTokenProvider(
                new ApiClient($authClientOptions),
                $accessTokenUrl,
                $credentials
            );
            $cacheKey = sha1($credentials->getClientId() . $credentials->getScope());
            $provider = new CacheTokenProvider($provider, $cache, $cacheKey);
        }
        return new OAuth2Handler($provider);
    }

    /**
     * Middleware that logs requests, responses, and errors using a message
     * formatter.
     *
     * @param LoggerInterface  $logger Logs messages.
     * @param MessageFormatter $formatter Formatter used to create message strings.
     * @param string           $logLevel Level at which to log requests.
     *
     * @return callable Returns a function that accepts the next handler.
     */
    private static function log(LoggerInterface $logger, MessageFormatter $formatter, $logLevel = LogLevel::INFO)
    {
        return function (callable $handler) use ($logger, $formatter, $logLevel) {
            return function ($request, array $options) use ($handler, $logger, $formatter, $logLevel) {
                return $handler($request, $options)->then(
                    function (ResponseInterface $response) use ($logger, $request, $formatter, $logLevel) {
                        $message = $formatter->format($request, $response);
                        $context = [
                            AbstractApiResponse::X_CORRELATION_ID => $response->getHeader(
                                AbstractApiResponse::X_CORRELATION_ID
                            )
                        ];
                        $logger->log($logLevel, $message, $context);
                        return $response;
                    },
                    function ($reason) use ($logger, $request, $formatter) {
                        $response = null;
                        $context = [];
                        if ($reason instanceof RequestException) {
                            $response = $reason->getResponse();
                            if (!is_null($response)) {
                                $context[AbstractApiResponse::X_CORRELATION_ID] = $response->getHeader(
                                    AbstractApiResponse::X_CORRELATION_ID
                                );
                            }
                        }
                        $message = $formatter->format($request, $response, $reason);
                        $logger->notice($message, $context);
                        return \GuzzleHttp\Promise\rejection_for($reason);
                    }
                );
            };
        };
    }

    /**
     * @return bool
     */
    private static function isGuzzle6()
    {
        if (is_null(self::$isGuzzle6)) {
            if (version_compare(Client::VERSION, '6.0.0', '>=')) {
                self::$isGuzzle6 = true;
            } else {
                self::$isGuzzle6 = false;
            }
        }
        return self::$isGuzzle6;
    }

    /**
     * @return ClientFactory
     */
    public static function of()
    {
        return new static();
    }
}
