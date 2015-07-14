<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Client\Adapter;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Error\ExceptionFactory;
use Sphere\Core\Error\SphereException;

class Guzzle6Adapter implements AdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($options)
    {
        $this->client = new Client($options);
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request)
    {
        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
        ];

        try {
            $response = $this->client->send($request, $options);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            throw SphereException::create($request, $response, $exception);
        }

        return $response;
    }

    /**
     * @param RequestInterface[] $requests
     * @return ResponseInterface[]
     */
    public function executeBatch(array $requests)
    {
        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
            'pool_size' => 25
        ];

        $results = Pool::batch(
            $this->client,
            $requests,
            $options
        );

        $responses = [];
        foreach ($results as $key => $result) {
            $httpResponse = $result;
            if ($result instanceof RequestException) {
                $request = $requests[$key];
                $httpResponse = $result->getResponse();
                $httpResponse = SphereException::create($request, $httpResponse, $result);
            }
            $responses[$key] = $httpResponse;
        }

        return $responses;
    }

    /**
     * @param $oauthUri
     * @param $clientId
     * @param $clientSecret
     * @param $formParams
     * @return ResponseInterface
     */
    public function authenticate($oauthUri, $clientId, $clientSecret, $formParams)
    {
        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
            'form_params' => $formParams,
            'auth' => [$clientId, $clientSecret]
        ];

        try {
            $response = $this->client->post($oauthUri, $options);
        } catch (RequestException $exception) {
            throw SphereException::create($exception->getRequest(), $exception->getResponse());
        }
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @return AdapterPromiseInterface
     */
    public function executeAsync(RequestInterface $request)
    {
        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
        ];
        $guzzlePromise = $this->client->sendAsync($request, $options);

        return new Guzzle6Promise($guzzlePromise);
    }
}
