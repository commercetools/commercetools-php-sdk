<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Pool;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Psr\Log\LoggerInterface;
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
    /**
     * @var Manager
     */
    protected $oauthManager;

    /**
     * @var ClientRequestInterface[]
     */
    protected $batchRequests;

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
     */
    protected function setOauthManager(Manager $oauthManager)
    {
        $this->oauthManager = $oauthManager;
    }

    /**
     * @param LoggerInterface $logger
     * @param string $format
     */
    protected function setLogger(LoggerInterface $logger = null, $format = null)
    {
        if ($logger instanceof LoggerInterface) {
            $subscriber = new LogSubscriber($logger, $format);
            $this->getHttpClient()->getEmitter()->attach($subscriber);
        }
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
        $client = $this->getHttpClient();
        try {
            $httpResponse = $client->send($this->createHttpRequest($request));
        } catch (RequestException $exception) {
            $httpResponse = $exception->getResponse();
        }

        $response = $request->buildResponse($httpResponse);

        return $response;
    }

    /**
     * @param ClientRequestInterface $request
     * @return RequestInterface
     */
    protected function createHttpRequest(ClientRequestInterface $request)
    {
        $client = $this->getHttpClient();

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
            'body' => $request->httpRequest()->getBody()
        ];

        return $client->createRequest($method, $request->httpRequest()->getPath(), $options);
    }

    /**
     * @return ApiResponseInterface[]
     */
    public function executeBatch()
    {
        $results = Pool::batch($this->getHttpClient(), $this->getBatchHttpRequests());

        $responses = [];
        foreach ($results as $key => $result) {
            $request = $this->batchRequests[$key];
            $responses[$request->getIdentifier()] = $request->buildResponse($result);
        }
        $this->batchRequests = [];

        return $responses;
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
     */
    public function addBatchRequest(ClientRequestInterface $request)
    {
        if ($request instanceof ContextAwareInterface) {
            $request->setContextIfNull($this->getConfig()->getContext());
        }
        $this->batchRequests[] = $request;
    }
}
