<?php

namespace Commercetools\Core\Client;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Commercetools\Core\Client\OAuth\ClientCredentials;
use Commercetools\Core\Client\OAuth\CredentialTokenProvider;
use Commercetools\Core\Client\OAuth\OAuth2Handler;
use Commercetools\Core\Client\OAuth\TokenProvider;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Error\DeprecatedException;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

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
     * @param Config|array $config
     * @param LoggerInterface $logger
     * @param CacheItemPoolInterface $cache
     * @param TokenProvider $provider
     * @return HttpClient
     */
    public function createClient(
        $config,
        LoggerInterface $logger = null,
        CacheItemPoolInterface $cache = null,
        TokenProvider $provider = null
    ) {
        $config = $this->createConfig($config);

        if (is_null($cache)) {
            $cacheDir = $config->getCacheDir();
            $cacheDir = !is_null($cacheDir) ? $cacheDir : realpath(__DIR__ . '/../../..');
            $filesystemAdapter = new Local($cacheDir);
            $filesystem        = new Filesystem($filesystemAdapter);
            $cache = new FilesystemCachePool($filesystem);
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

        return $this->createGuzzle6Client($options, $oauthHandler, $logger, $config->getCorrelationIdProvider());
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
     * @param array $options
     * @param LoggerInterface|null $logger
     * @param OAuth2Handler $oauthHandler
     * @return HttpClient
     */
    private function createGuzzle6Client(
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

        if (!is_null($correlationIdProvider)) {
            $handler->push(Middleware::mapRequest(function (RequestInterface $request) use ($correlationIdProvider) {
                return $request->withAddedHeader(
                    AbstractApiResponse::X_CORRELATION_ID,
                    $correlationIdProvider->getCorrelationId()
                );
            }), 'ctp_correlation_id');
        }

        $client = new HttpClient($options);

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
     * @param ClientCredentials $credentials
     * @param string $accessTokenUrl
     * @param CacheItemPoolInterface $cache
     * @param TokenProvider $provider
     * @param array $authClientOptions
     * @return OAuth2Handler
     */
    private function getHandler(
        ClientCredentials $credentials,
        $accessTokenUrl,
        CacheItemPoolInterface $cache = null,
        TokenProvider $provider = null,
        array $authClientOptions = []
    ) {
        if (is_null($provider)) {
            $provider = new CredentialTokenProvider(
                new HttpClient($authClientOptions),
                $accessTokenUrl,
                $credentials
            );
        }
        return new OAuth2Handler($provider, $cache);
    }

    /**
     * @return bool
     */
    private static function isGuzzle6()
    {
        if (is_null(self::$isGuzzle6)) {
            if (version_compare(HttpClient::VERSION, '6.0.0', '>=')) {
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
