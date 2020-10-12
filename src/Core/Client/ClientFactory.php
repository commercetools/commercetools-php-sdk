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
use Commercetools\Core\Error\Message;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Client as HttpClient;
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

/**
 * The factory to create a Client for communicating with the commercetools platform
 *
 * @description
 * This factory will create a Guzzle HTTP Client preconfigured for talking to the commercetools platform
 *
 * ## Instantiation
 *
 * ```php
 * $config = Config::fromArray(
 *  ['client_id' => '<client_id>', 'client_secret' => '<client_secret>', 'project' => '<project>']
 * );
 * $client = ClientFactory::of()->createClient($config);
 * ```
 *
 * ## Execution
 *
 * ### Synchronous
 *
 * ```php
 * $request = ProductProjectionSearchRequest::of();
 * $response = $client->execute($request);
 * $products = $request->mapFromResponse($response);
 * ```
 *
 * ### Asynchronous
 * The asynchronous execution will return a promise to fulfill the request.
 *
 * ```php
 * $request = ProductProjectionSearchRequest::of();
 * $response = $client->executeAsync($request);
 * $products = $request->mapFromResponse($response->wait());
 * ```
 *
 * ### Batch
 * By filling the batch queue and starting the execution all requests will be executed in parallel.
 *
 * ```php
 * $responses = Pool::batch(
 *     $client,
 *     [ProductProjectionSearchRequest::of()->httpRequest(), CartByIdGetRequest::ofId($cartId)->httpRequest()]
 * );
 * ```
 *
 * ## Instantiation options
 *
 * ### Using a logger
 *
 * The client uses the PSR-3 logger interface for logging requests and deprecation notices. To enable
 * logging provide a PSR-3 compliant logger (e.g. Monolog).
 *
 * ```php
 * $logger = new \Monolog\Logger('name');
 * $logger->pushHandler(new StreamHandler('./requests.log'));
 * $client = ClientFactory::of()->createClient($config, $logger);
 * ```
 *
 * ### Using a cache adapter ###
 *
 * The client will automatically request an OAuth token and store the token in the provided cache.
 *
 * It's also possible to use a different cache adapter. The SDK provides a Doctrine, a Redis and an APCu cache adapter.
 * By default the SDK tries to instantiate the APCu or a PSR-6 filesystem cache adapter if there is no cache given.
 * E.g. Redis:
 *
 * ```php
 * $redis = new \Redis();
 * $redis->connect('localhost');
 * $client = ClientFactory::of()->createClient($config, null, $cache);
 * ```
 *
 * #### Using cache and logger ####
 *
 * ```php
 * $client = ClientFactory::of()->createClient($config, $logger, $cache);
 * ```
 *
 * #### Using a custom cache adapter ####
 *
 * ```php
 * class <CacheClass>Adapter implements \Psr\Cache\CacheItemPoolInterface {
 *     protected $cache;
 *     public function __construct(<CacheClass> $cache) {
 *         $this->cache = $cache;
 *     }
 * }
 *
 * $client->getAdapterFactory()->registerCallback(function ($cache) {
 *     if ($cache instanceof <CacheClass>) {
 *         return new <CacheClass>Adapter($cache);
 *     }
 *     return null;
 * });
 * ```
 *
 * ### Using a custom client class
 *
 * If some additional configuration is needed or the client should have custom logic you could provide a class name
 * to be used for the client instance. This class has to be an extended Guzzle client.
 *
 * ```php
 * $client = ClientFactory::of()->createCustomClient(MyCustomClient::class, $config);
 * ```
 *
 * ## Middlewares
 *
 * Adding middlewares to the clients for platform as well for the authentication can be done using the config
 * by setting client options.
 *
 * ### Using a HandlerStack
 *
 * ```php
 * $handler = HandlerStack::create();
 * $handler->push(Middleware::mapRequest(function (RequestInterface $request) {
 *     ...
 *     return $request; })
 * );
 * $config = Config::of()->setClientOptions(['handler' => $handler])
 * ```
 *
 * ### Using a middleware array
 *
 * ```php
 * $middlewares = [
 *     Middleware::mapRequest(function (RequestInterface $request) {
 *     ...
 *     return $request; }),
 *     ...
 * ]
 * $config = Config::of()->setClientOptions(['middlewares' => $middlewares])
 * ```
 *
 * @package Commercetools\Core\Client
 */
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

        if (is_null($context)) {
            $context = $config->getContext();
        }
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
            $config->getOAuthClientOptions(),
            $config->getCorrelationIdProvider()
        );

        $options = $this->getDefaultOptions($config);

        $client = $this->createGuzzle6Client(
            $clientClass,
            $options,
            $oauthHandler,
            $logger,
            $config->getCorrelationIdProvider()
        );

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

    public function createAuthClient(
        array $options = [],
        CorrelationIdProvider $correlationIdProvider = null
    ) {
        if (isset($options['handler']) && $options['handler'] instanceof HandlerStack) {
            $handler = $options['handler'];
        } else {
            $handler = HandlerStack::create();
            $options['handler'] = $handler;
        }

        $handler->remove("http_errors");
        $handler->unshift(self::httpErrors(), 'ctp_http_errors');

        $this->setCorrelationIdMiddleware($handler, $correlationIdProvider);

        $options = $this->addMiddlewares($handler, $options);

        return new Client($options);
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

        $this->setCorrelationIdMiddleware($handler, $correlationIdProvider);
        $options = $this->addMiddlewares($handler, $options);

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
     * @param CorrelationIdProvider $correlationIdProvider
     * @param HandlerStack $handler
     */
    private function setCorrelationIdMiddleware(
        HandlerStack $handler,
        CorrelationIdProvider $correlationIdProvider = null
    ) {
        if (!is_null($correlationIdProvider)) {
            $handler->push(Middleware::mapRequest(function (RequestInterface $request) use ($correlationIdProvider) {
                return $request->withAddedHeader(
                    AbstractApiResponse::X_CORRELATION_ID,
                    $correlationIdProvider->getCorrelationId()
                );
            }), 'ctp_correlation_id');
        }
    }

    /**
     * @param HandlerStack $handler
     * @param array $options
     * @return array
     */
    private function addMiddlewares(HandlerStack $handler, array $options)
    {
        if (isset($options['middlewares']) && is_array($options['middlewares'])) {
            foreach ($options['middlewares'] as $key => $middleware) {
                if (is_callable($middleware)) {
                    if (!is_numeric($key)) {
                        $handler->remove($key);
                        $handler->push($middleware, $key);
                    } else {
                        $handler->push($middleware);
                    }
                }
            }
        }
        return $options;
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
     * @param CorrelationIdProvider|null $correlationIdProvider
     * @return OAuth2Handler
     */
    private function getHandler(
        ClientCredentials $credentials,
        $accessTokenUrl,
        $cache,
        TokenProvider $provider = null,
        array $authClientOptions = [],
        CorrelationIdProvider $correlationIdProvider = null
    ) {
        if (is_null($provider)) {
            $provider = new CredentialTokenProvider(
                $this->createAuthClient($authClientOptions, $correlationIdProvider),
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
            if (defined('\GuzzleHttp\Client::MAJOR_VERSION')) {
                $clientVersion = (string) constant(HttpClient::class . '::MAJOR_VERSION');
            } else {
                $clientVersion = (string) constant(HttpClient::class . '::VERSION');
            }
            if (version_compare($clientVersion, '6.0.0', '>=')) {
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
