<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Pool;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\ApiException;

class Guzzle6Adapter implements AdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    protected $logger;

    public function __construct(array $options = [])
    {
        $options = array_merge(
            [
                'allow_redirects' => false,
                'verify' => true,
                'timeout' => 60,
                'connect_timeout' => 10,
                'pool_size' => 25
            ],
            $options
        );
        $this->client = new Client($options);
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->client->getConfig('handler')->push(Middleware::log($logger, new MessageFormatter()));
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request)
    {
        try {
            $response = $this->client->send($request);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            throw ApiException::create($request, $response, $exception);
        }

        return $response;
    }

    /**
     * @param RequestInterface[] $requests
     * @return ResponseInterface[]
     */
    public function executeBatch(array $requests)
    {
        $results = Pool::batch(
            $this->client,
            $requests
        );

        $responses = [];
        foreach ($results as $key => $result) {
            $httpResponse = $result;
            if ($result instanceof RequestException) {
                $request = $requests[$key];
                $httpResponse = $result->getResponse();
                $httpResponse = ApiException::create($request, $httpResponse, $result);
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
            'form_params' => $formParams,
            'auth' => [$clientId, $clientSecret]
        ];

        try {
            $response = $this->client->post($oauthUri, $options);
        } catch (RequestException $exception) {
            throw ApiException::create($exception->getRequest(), $exception->getResponse(), $exception);
        }
        return $response;
    }

    /**
     * @param RequestInterface $request
     * @return AdapterPromiseInterface
     */
    public function executeAsync(RequestInterface $request)
    {
        $guzzlePromise = $this->client->sendAsync($request);

        return new Guzzle6Promise($guzzlePromise);
    }
}
