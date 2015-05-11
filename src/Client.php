<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Pool;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Psr\Log\LoggerInterface;
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
    protected function setLogger(LoggerInterface $logger = null, $format = null)
    {
        if ($logger instanceof LoggerInterface) {
            $this->logger = $logger;
            $subscriber = new LogSubscriber($logger, $format);
            $this->getHttpClient()->getEmitter()->attach($subscriber);
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
        try {
            $response = $this->sendRequest($request, false);
        } catch (RequestException $exception) {
            $httpResponse = $exception->getResponse();
            if (is_null($httpResponse)) {
                throw $exception;
            }
            $response = $request->buildResponse($httpResponse);
        }
        $this->logDeprecatedMethod($response);

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @param bool $future
     * @return ApiResponseInterface
     */
    protected function sendRequest(ClientRequestInterface $request, $future = true)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getConfig()->getContext());
        }
        $httpResponse = $this->getHttpClient()->send($this->createHttpRequest($request, $future));

        $response = $request->buildResponse($httpResponse);

        return $response;
    }
    /**
     * @param ClientRequestInterface $request
     * @return ApiResponseInterface
     */
    public function future(ClientRequestInterface $request)
    {
        $response = $this->sendRequest($request);
        $response->then(
            function ($httpResponse) use ($request) {
                $this->logDeprecatedMethod($request->buildResponse($httpResponse));
                return $httpResponse;
            }
        );

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @param bool $future
     * @return RequestInterface
     */
    protected function createHttpRequest(ClientRequestInterface $request, $future = false)
    {
        $method = $request->httpRequest()->getHttpMethod();
        $token = $this->getOAuthManager()->getToken();
        $headers = [
            'Authorization' => 'Bearer ' . $token->getToken()
        ];

        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
            'headers' => $headers,
            'body' => $request->httpRequest()->getBody(),
            'future' => $future,
            'exceptions' => !$future
        ];

        return $this->getHttpClient()->createRequest($method, $request->httpRequest()->getPath(), $options);
    }

    /**
     * @return ApiResponseInterface[]
     */
    public function executeBatch()
    {
        $results = Pool::batch(
            $this->getHttpClient(),
            $this->getBatchHttpRequests(),
            ['pool_size' => $this->getConfig()->getBatchPoolSize()]
        );

        $responses = [];
        foreach ($results as $key => $result) {
            $request = $this->batchRequests[$key];
            $httpResponse = $result;
            if ($result instanceof RequestException) {
                $httpResponse = $result->getResponse();
                if (is_null($httpResponse)) {
                    throw $result;
                }
            }
            $responses[$request->getIdentifier()] = $request->buildResponse($httpResponse);
            $this->logDeprecatedMethod($responses[$request->getIdentifier()]);
        }
        $this->batchRequests = [];

        return $responses;
    }

    /**
     * @param ApiResponseInterface $response
     * @return $this
     */
    protected function logDeprecatedMethod(ApiResponseInterface $response)
    {
        if (is_null($this->logger)) {
            return $this;
        }
        $deprecatedMessage = $response->getHeader(static::DEPRECATION_HEADER);
        if (!empty($deprecatedMessage)) {
            $message = sprintf(
                Message::DEPRECATED_METHOD,
                $response->getRequest()->httpRequest()->getPath(),
                $response->getRequest()->httpRequest()->getHttpMethod(),
                $deprecatedMessage
            );
            $this->logger->warning($message);
        }
        return $this;
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
