<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Commercetools\Core;

use Commercetools\Core\Client\Adapter\CorrelationIdAware;
use Commercetools\Core\Client\Adapter\TokenProviderAware;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Client\Adapter\AdapterOptionInterface;
use Commercetools\Core\Model\Common\ContextTrait;
use Commercetools\Core\Response\ErrorResponse;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Client\Adapter\AdapterInterface;
use Commercetools\Core\Error\InvalidTokenException;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Model\Common\ContextAwareInterface;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Request\ClientRequestInterface;
use Commercetools\Core\Client\OAuth\Manager;

/**
 * The client for communicating with the commercetools platform
 *
 * @description
 * ## Instantiation
 *
 * ```php
 * $config = Config::fromArray(
 *  ['client_id' => '<client_id>', 'client_secret' => '<client_secret>', 'project' => '<project>']
 * );
 * $client = Client::ofConfig($config);
 * ```
 *
 * ## Execution
 *
 * ### Synchronous
 * There are two main approaches for retrieving result objects
 *
 * Client centric:
 *
 * ```php
 * $response = $client->execute(ProductProjectionSearchRequest::of());
 * $products = $response->toObject();
 * ```
 *
 * Request centric:
 *
 * ```php
 * $request = ProductProjectionSearchRequest::of();
 * $response = $request->executeWithClient($client);
 * $products = $request->mapFromResponse($response);
 * ```
 *
 * By using the request centric approach the IDE is capable of resolving the correct classes and give
 * a maximum of support with available methods.
 *
 * ### Asynchronous
 * The asynchronous execution will return a promise to fulfill the request.
 *
 * ```php
 * $response = $client->executeAsync(ProductProjectionSearchRequest::of());
 * ```
 *
 * ### Batch
 * By filling the batch queue and starting the execution all requests will be executed in parallel.
 *
 * ```php
 * $client->addBatchRequest(ProductProjectionSearchRequest::of())
 *     ->addBatchRequest(CartByIdGetRequest::ofId($cartId));
 * $responses = $client->executeBatch();
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
 * $client = Client::ofConfigAndLogger($config, $logger);
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
 * $client = Client::ofConfigAndCache($config, $redis);
 * ```
 *
 * #### Using cache and logger ####
 *
 * ```php
 * $client = Client::ofConfigCacheAndLogger($config, $cache, $logger);
 * ```
 *
 * #### Using a custom cache adapter ####
 *
 * ```php
 * class <CacheClass>Adapter implements \Commercetools\Core\Cache\CacheAdapterInterface {
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
 * @package Commercetools\Core
 */
class Client extends AbstractHttpClient implements LoggerAwareInterface, ContextAwareInterface
{
    use ContextTrait;

    const DEPRECATION_HEADER = 'X-DEPRECATION-NOTICE';

    /**
     * @sideeffect Test123
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Manager
     */
    protected $oauthManager;

    /**
     * @var ClientRequestInterface[]
     */
    protected $batchRequests = [];

    protected $tokenRefreshed = false;

    protected $project;

    /**
     * @param array|Config $config
     * @param $cache
     * @param LoggerInterface $logger
     */
    public function __construct($config, $cache = null, LoggerInterface $logger = null)
    {
        parent::__construct($config);

        $manager = new Manager($config, $cache);
        $this->setOauthManager($manager);
        $this->setLogger($logger);
    }

    /**
     * @param Config|array $config
     * @return $this
     */
    public function setConfig($config)
    {
        $config->getCredentials()->check();
        parent::setConfig($config);
        $this->project = $config->getCredentials()->getProject();
        $this->setContext($config->getContext());

        return $this;
    }

    /**
     * @return Manager
     */
    public function getOauthManager()
    {
        return $this->oauthManager;
    }

    /**
     * @param Manager $oauthManager
     * @return $this
     */
    protected function setOauthManager(Manager $oauthManager)
    {
        $this->oauthManager = $oauthManager;
        return $this;
    }

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger = null)
    {
        if ($logger instanceof LoggerInterface) {
            $this->logger = $logger;
        }
        return $this;
    }

    /**
     * @param array $options
     * @return AdapterInterface
     */
    public function getHttpClient($options = [])
    {
        if (is_null($this->httpClient)) {
            $clientOptions = $this->clientConfig->getClientOptions();
            if (count($clientOptions) > 0) {
                $options = array_merge($clientOptions, $options);
            }
            $client = parent::getHttpClient($options);
            if ($client instanceof TokenProviderAware) {
                $client->setOAuthTokenProvider($this->getOauthManager());
            }
            if ($this->logger instanceof LoggerInterface) {
                $client->setLogger(
                    $this->logger,
                    $this->clientConfig->getLogLevel(),
                    $this->clientConfig->getMessageFormatter()
                );
            }
            if ($this->clientConfig->getCorrelationIdProvider() instanceof CorrelationIdProvider
                && $client instanceof CorrelationIdAware
            ) {
                $client->setCorrelationIdProvider($this->clientConfig->getCorrelationIdProvider());
            }
            $this->httpClient = $client;
        }

        return $this->httpClient;
    }


    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->clientConfig->getBaseUri() . '/' . $this->project . '/';
    }

    /**
     * Executes an API request synchronously
     *
     * @param ClientRequestInterface $request
     * @param array $headers
     * @param array $clientOptions
     * @return ApiResponseInterface
     * @throws ApiException
     * @throws InvalidTokenException
     */
    public function execute(ClientRequestInterface $request, array $headers = null, array $clientOptions = [])
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getContext());
        }
        $httpRequest = $this->createHttpRequest($request, $headers);

        try {
            $client = $this->getHttpClient();
            if ($client instanceof AdapterOptionInterface) {
                $httpResponse = $client->execute($httpRequest, $clientOptions);
            } else {
                $httpResponse = $client->execute($httpRequest);
            }
            $response = $request->buildResponse($httpResponse);
        } catch (ApiException $exception) {
            if ($exception instanceof InvalidTokenException && !$this->tokenRefreshed) {
                $this->tokenRefreshed = true;
                $this->getOauthManager()->refreshToken();
                return $this->execute($request);
            }
            if ($this->clientConfig->isThrowExceptions() || !$exception->getResponse() instanceof ResponseInterface) {
                throw $exception;
            }
            $httpResponse = $exception->getResponse();
            $this->logException($exception);
            $response = new ErrorResponse($exception, $request, $httpResponse);
        }
        $this->logDeprecatedRequest($httpResponse, $httpRequest);


        return $response;
    }

    /**
     * Executes an API request asynchronously
     * @param ClientRequestInterface $request
     * @param array $clientOptions
     * @return ApiResponseInterface
     */
    public function executeAsync(ClientRequestInterface $request, array $headers = null, array $clientOptions = [])
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getContext());
        }
        $httpRequest = $this->createHttpRequest($request, $headers);
        $client = $this->getHttpClient();
        if ($client instanceof AdapterOptionInterface) {
            $response = $request->buildResponse($client->executeAsync($httpRequest, $clientOptions));
        } else {
            $response = $request->buildResponse($client->executeAsync($httpRequest));
        }

        $response = $response->then(
            function ($httpResponse) use ($httpRequest) {
                $this->logDeprecatedRequest($httpResponse, $httpRequest);
                return $httpResponse;
            }
        );

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @param array $headers
     * @return RequestInterface
     */
    protected function createHttpRequest(ClientRequestInterface $request, array $headers = null)
    {
        $httpRequest = $request->httpRequest();
        if (!$this->getHttpClient() instanceof TokenProviderAware) {
            $token = $this->getOauthManager()->getToken();
            $httpRequest = $httpRequest
                ->withHeader('Authorization', 'Bearer ' . $token->getToken())
            ;
        }
        if (is_array($headers)) {
            foreach ($headers as $headerName => $headerValues) {
                $httpRequest = $httpRequest
                    ->withAddedHeader($headerName, $headerValues)
                ;
            }
        }

        return $httpRequest;
    }

    /**
     * Executes API requests in batch
     * @param array $headers
     * @param array $clientOptions
     * @return ApiResponseInterface[]
     * @throws ApiException
     */
    public function executeBatch(array $headers = null, array $clientOptions = [])
    {
        $requests = $this->getBatchHttpRequests($headers);
        $client = $this->getHttpClient();
        if ($client instanceof AdapterOptionInterface) {
            $httpResponses = $client->executeBatch($requests, $clientOptions);
        } else {
            $httpResponses = $client->executeBatch($requests);
        }

        $responses = [];
        foreach ($httpResponses as $key => $httpResponse) {
            $request = $this->batchRequests[$key];
            $httpRequest = $requests[$key];
            if ($httpResponse instanceof ApiException) {
                $exception = $httpResponse;
                if ($this->clientConfig->isThrowExceptions() ||
                    !$httpResponse->getResponse() instanceof ResponseInterface
                ) {
                    throw $exception;
                }
                $this->logException($httpResponse);
                $httpResponse = $exception->getResponse();
                $responses[$request->getIdentifier()] = new ErrorResponse(
                    $exception,
                    $request,
                    $httpResponse
                );
            } else {
                $responses[$request->getIdentifier()] = $request->buildResponse($httpResponse);
            }
            $this->logDeprecatedRequest($httpResponse, $httpRequest);
        }
        unset($this->batchRequests);
        $this->batchRequests = [];

        return $responses;
    }

    /**
     * @param $exception
     * @return $this
     */
    protected function logException(ApiException $exception)
    {
        if (is_null($this->logger)) {
            return $this;
        }
        $response = $exception->getResponse();

        $context = [];
        if ($response instanceof ResponseInterface) {
            $context = [
                'responseStatusCode' => $response->getStatusCode(),
                'responseHeaders' => $response->getHeaders(),
                'responseBody' => (string)$response->getBody(),
            ];
        }
        $this->logger->error($exception->getMessage(), $context);

        return $this;
    }

    /**
     * @param ResponseInterface $response
     * @param RequestInterface $request
     * @return $this
     */
    protected function logDeprecatedRequest(ResponseInterface $response, RequestInterface $request)
    {
        if (is_null($this->logger)) {
            return $this;
        }

        if ($response->hasHeader(static::DEPRECATION_HEADER)) {
            $message = sprintf(
                Message::DEPRECATED_METHOD,
                $request->getUri(),
                $request->getMethod(),
                $response->getHeaderLine(static::DEPRECATION_HEADER)
            );
            $this->logger->warning($message);
        }
        return $this;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return string
     */
    protected function format(RequestInterface $request, ResponseInterface $response)
    {
        $entries = [
            $request->getMethod(),
            (string)$request->getUri(),
            $response->getStatusCode()
        ];
        return implode(', ', $entries);
    }

    /**
     * @param array $headers
     * @return array
     */
    protected function getBatchHttpRequests(array $headers = null)
    {
        $requests = array_map(
            function ($request) use ($headers) {
                return $this->createHttpRequest($request, $headers);
            },
            $this->batchRequests
        );

        return $requests;
    }

    /**
     * Adds a request to the batch execution queue
     * @param ClientRequestInterface $request
     * @return $this
     */
    public function addBatchRequest(ClientRequestInterface $request)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getContext());
        }
        $this->batchRequests[] = $request;
        return $this;
    }

    /**
     * Instantiates a client with the given config
     * @param Config $config
     * @return static
     */
    public static function ofConfig(Config $config)
    {
        return new static($config);
    }

    /**
     * Instantiates a client with the given config and cache adapter
     * @param Config $config
     * @param $cache
     * @return static
     */
    public static function ofConfigAndCache(Config $config, $cache)
    {
        return new static($config, $cache);
    }

    /**
     * Instantiates a client with the given config and a PSR-3 compliant logger
     * @param Config $config
     * @param LoggerInterface $logger
     * @return static
     */
    public static function ofConfigAndLogger(Config $config, LoggerInterface $logger)
    {
        return new static($config, null, $logger);
    }

    /**
     * Instantiates a client with the given config, a cache adapter and a PSR-3 compliant logger
     * @param Config $config
     * @param $cache
     * @param LoggerInterface $logger
     * @return static
     */
    public static function ofConfigCacheAndLogger(Config $config, $cache, LoggerInterface $logger)
    {
        return new static($config, $cache, $logger);
    }
}
