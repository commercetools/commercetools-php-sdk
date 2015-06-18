<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Client\Adapter;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Guzzle5Adapter implements AdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($options)
    {
        if (isset($options['base_uri'])) {
            $options['base_url'] = $options['base_uri'];
            unset($options['base_uri']);
        }
        $this->client = new Client($options);
    }

    /**
     * @internal
     * @return \GuzzleHttp\Event\Emitter|\GuzzleHttp\Event\EmitterInterface
     */
    public function getEmitter()
    {
        return $this->client->getEmitter();
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
            'headers' => $request->getHeaders(),
            'body' => (string)$request->getBody()
        ];

        try {
            $request = $this->client->createRequest($request->getMethod(), (string)$request->getUri(), $options);
            $response = $this->packResponse($this->client->send($request));
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            if (is_null($response)) {
                throw $exception;
            }
            $response = $this->packResponse($response);
        }

        return $response;
    }

    protected function packResponse(\GuzzleHttp\Message\ResponseInterface $response)
    {
        return new Response(
            $response->getStatusCode(),
            $response->getHeaders(),
            (string)$response->getBody()
        );
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
            $this->getBatchHttpRequests($requests),
            $options
        );

        $responses = [];
        foreach ($results as $key => $result) {
            $httpResponse = $result;
            if ($result instanceof RequestException) {
                $httpResponse = $result->getResponse();
                if (is_null($httpResponse)) {
                    throw $result;
                }
            }
            $responses[$key] = $this->packResponse($httpResponse);
        }

        return $responses;
    }

    /**
     * @return array
     */
    protected function getBatchHttpRequests(array $requests)
    {
        $requests = array_map(
            function ($request) {
                /**
                 * @var RequestInterface $request
                 */
                return $this->client->createRequest(
                    $request->getMethod(),
                    (string)$request->getUri(),
                    ['headers' => $request->getHeaders()]
                );
            },
            $requests
        );

        return $requests;
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
            'body' => $formParams,
            'auth' => [$clientId, $clientSecret]
        ];

        try {
            $response = $this->client->post($oauthUri, $options);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            if (is_null($response)) {
                throw $exception;
            }
        }
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @return AdapterPromiseInterface
     */
    public function future(RequestInterface $request)
    {
        $options = [
            'allow_redirects' => false,
            'verify' => true,
            'timeout' => 60,
            'connect_timeout' => 10,
            'future' => true,
            'exceptions' => false,
            'headers' => $request->getHeaders()
        ];
        $request = $this->client->createRequest($request->getMethod(), (string)$request->getUri(), $options);
        $guzzlePromise = $this->client->send($request, $options);

        $promise = new Guzzle5Promise($guzzlePromise);
        $promise->then(
            function (\GuzzleHttp\Message\ResponseInterface $response) {
                return new Response(
                    $response->getStatusCode(),
                    $response->getHeaders(),
                    (string)$response->getBody(),
                    $response->getProtocolVersion(),
                    $response->getReasonPhrase()
                );
            }
        );

        return $promise;
    }
}
