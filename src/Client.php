<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Sphere\Core\Client\Adapter\AdapterInterface;
use Sphere\Core\Error\InvalidTokenException;
use Sphere\Core\Error\Message;
use Sphere\Core\Error\SphereException;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Response\ApiResponseInterface;
use Sphere\Core\Request\ClientRequestInterface;
use Sphere\Core\Client\OAuth\Manager;

/**
 * Class Client
 * @package Sphere\Core
 */
class Client extends AbstractHttpClient
{
    const DEPRECATION_HEADER = 'X-DEPRECATION-NOTICE';

    /**
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
    protected function setLogger(LoggerInterface $logger = null)
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
            $client = parent::getHttpClient($options);
            if ($this->logger instanceof LoggerInterface) {
                $client->setLogger($this->logger);
            }
        }

        return $this->httpClient;
    }


    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/';
    }

    /**
     * @param ClientRequestInterface $request
     * @return ApiResponseInterface
     */
    public function execute(ClientRequestInterface $request)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getConfig()->getContext());
        }
        $httpRequest = $this->createHttpRequest($request);

        try {
            $response = $this->getHttpClient()->execute($httpRequest);
        } catch (SphereException $exception) {
            if ($exception instanceof InvalidTokenException && !$this->tokenRefreshed) {
                $this->tokenRefreshed = true;
                $this->getOauthManager()->refreshToken();
                return $this->execute($request);
            }
            if ($this->getConfig()->getThrowExceptions() || !$exception->getResponse() instanceof ResponseInterface) {
                throw $exception;
            }
            $response = $exception->getResponse();
        }
        $this->logDeprecatedRequest($response, $httpRequest);

        $response = $request->buildResponse($response);

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @return ApiResponseInterface
     */
    public function executeAsync(ClientRequestInterface $request)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getConfig()->getContext());
        }
        $httpRequest = $this->createHttpRequest($request);
        $response = $request->buildResponse($this->getHttpClient()->executeAsync($httpRequest));

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
     * @return RequestInterface
     */
    protected function createHttpRequest(ClientRequestInterface $request)
    {
        $token = $this->getOAuthManager()->getToken();

        $httpRequest = $request->httpRequest();
//        $uri = $httpRequest->getUri()->withPath($this->getConfig()->getProject() . $httpRequest->getUri()->getPath());
        $httpRequest = $httpRequest
//            ->withUri($uri)
            ->withHeader('Authorization', 'Bearer ' . $token->getToken())
        ;
        return $httpRequest;
    }

    /**
     * @return ApiResponseInterface[]
     */
    public function executeBatch()
    {
        $requests = $this->getBatchHttpRequests();
        $httpResponses = $this->getHttpClient()->executeBatch($requests);

        $responses = [];
        foreach ($httpResponses as $key => $httpResponse) {
            $request = $this->batchRequests[$key];
            $httpRequest = $requests[$key];
            if ($httpResponse instanceof SphereException) {
                if ($this->getConfig()->getThrowExceptions() ||
                    !$httpResponse->getResponse() instanceof ResponseInterface
                ) {
                    throw $httpResponse;
                }
                $httpResponse = $httpResponse->getResponse();
            }
            $responses[$request->getIdentifier()] = $request->buildResponse($httpResponse);
            $this->logDeprecatedRequest($httpResponse, $httpRequest);
        }
        $this->batchRequests = [];

        return $responses;
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
     * @return array
     */
    protected function getBatchHttpRequests()
    {
        $requests = array_map(
            function ($request) {
                return $this->createHttpRequest($request);
            },
            $this->batchRequests
        );

        return $requests;
    }

    /**
     * @param ClientRequestInterface $request
     * @return $this
     */
    public function addBatchRequest(ClientRequestInterface $request)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getConfig()->getContext());
        }
        $this->batchRequests[] = $request;
        return $this;
    }

    /**
     * @param Config $config
     * @return static
     */
    public static function ofConfig(Config $config)
    {
        return new static($config);
    }

    /**
     * @param Config $config
     * @param $cache
     * @return static
     */
    public static function ofConfigAndCache(Config $config, $cache)
    {
        return new static($config, $cache);
    }

    /**
     * @param Config $config
     * @param LoggerInterface $logger
     * @return static
     */
    public static function ofConfigAndLogger(Config $config, LoggerInterface $logger)
    {
        return new static($config, null, $logger);
    }

    /**
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
