<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Sphere\Core\Error\Message;
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

    /**
     * @param array|Config $config
     * @param $cache
     * @param LoggerInterface $logger
     * @param string $logFormat Guzzle log formatter string
     *      @link https://github.com/guzzle/log-subscriber#logging-with-a-custom-message-format
     */
    public function __construct($config, $cache = null, LoggerInterface $logger = null, $logFormat = null)
    {
        parent::__construct($config);

        $manager = new Manager($config, $cache);
        $this->setOauthManager($manager);
        $this->setLogger($logger, $logFormat);
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
     * @param string $format
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
        $httpRequest = $this->createHttpRequest($request);

        try {
            $response = $this->getHttpClient()->execute($httpRequest);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            if (is_null($response)) {
                throw $exception;
            }
        }
        $this->logRequest($response, $httpRequest);

        $response = $request->buildResponse($response);

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @return ApiResponseInterface
     */
    public function future(ClientRequestInterface $request)
    {
        $httpRequest = $this->createHttpRequest($request);
        $response = $request->buildResponse($this->getHttpClient()->future($httpRequest));

        $response = $response->then(
            function ($httpResponse) use ($httpRequest) {
                $this->logRequest($httpResponse, $httpRequest);
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
        $uri = $httpRequest->getUri()->withPath($this->getConfig()->getProject() . $httpRequest->getUri()->getPath());
        $httpRequest = $httpRequest
            ->withUri($uri)
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
            $responses[$request->getIdentifier()] = $request->buildResponse($httpResponse);
            $this->logRequest($httpResponse, $httpRequest);
        }
        $this->batchRequests = [];

        return $responses;
    }

    /**
     * @param ResponseInterface $response
     * @param RequestInterface $request
     * @return $this
     */
    protected function logRequest(ResponseInterface $response, RequestInterface $request)
    {
        if (is_null($this->logger)) {
            return $this;
        }

        $this->logger->log(
            $this->getLogLevel($response),
            $this->format($request, $response),
            ['request' => $request, 'response' => $response]
        );
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

    protected function getLogLevel(ResponseInterface $response)
    {
        return substr($response->getStatusCode(), 0, 1) == '2' ? LogLevel::INFO : LogLevel::WARNING;
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
}
