<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Psr\Log\LoggerInterface;
use Sphere\Core\Http\ApiResponseInterface;
use Sphere\Core\Http\ClientRequestInterface;
use Sphere\Core\OAuth\Manager;

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
     * @param array|Config $config
     * @param $cache
     * @param LoggerInterface $logger
     * @param string $logFormat Guzzle log formatter string
     *      @see https://github.com/guzzle/log-subscriber#logging-with-a-custom-message-format
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
    public function setOauthManager(Manager $oauthManager)
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
        $token = $this->getOAuthManager()->getToken();

        $client = $this->getHttpClient();

        $method = $request->httpRequest()->getHttpMethod();
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

        $httpRequest = $client->createRequest($method, $request->httpRequest()->getPath(), $options);
        try {
            $httpResponse = $client->send($httpRequest);
        } catch (ClientException $exception) {
            $httpResponse = $exception->getResponse();
        }

        $response = $request->buildResponse($httpResponse);

        return $response;
    }
}
