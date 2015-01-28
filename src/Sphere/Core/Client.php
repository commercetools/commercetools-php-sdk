<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use GuzzleHttp\Exception\ClientException;
use Sphere\Core\Http\ClientRequest;
use Sphere\Core\OAuth\Manager;
use Sphere\Core\Response\ApiResponse;

class Client extends AbstractHttpClient
{
    /**
     * @var Manager
     */
    protected $oauthManager;

    public function __construct($config, $cache = null)
    {
        parent::__construct($config);

        $manager = new Manager($config, $cache);
        $this->setOauthManager($manager);
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
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/';
    }

    /**
     * @param ClientRequest $request
     * @return ApiResponse
     */
    public function execute(ClientRequest $request)
    {
        $token = $this->getOAuthManager()->getToken();

        $client = $this->getHttpClient();
        $method = $request->httpRequest()->getHttpMethod();
        $headers = [
            'Authorization' => 'Bearer ' . $token->getToken()
        ];

        $options = [
            'headers' => $headers,
            'body' => $request->httpRequest()->getBody()
        ];

        $httpRequest = $client->createRequest($method, $request->httpRequest()->getPath(), $options);
        try {
            $httpResponse = $client->send($httpRequest);
        } catch(ClientException $exception) {
            $httpResponse = $exception->getResponse();
        }

        $response = $request->buildResponse($httpResponse);

        return $response;
    }
}
