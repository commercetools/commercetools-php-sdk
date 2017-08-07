<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Commercetools\Core\Client\OAuth\TokenProvider;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Helper\Subscriber\CorrelationIdSubscriber;
use Commercetools\Core\Helper\Subscriber\TokenSubscriber;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Helper\Subscriber\Log\LogSubscriber;
use Commercetools\Core\Error\ApiException;
use Psr\Log\LogLevel;

class Guzzle5Adapter implements AdapterInterface, CorrelationIdAware, TokenProviderAware
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (isset($options['base_uri'])) {
            $options['base_url'] = $options['base_uri'];
            unset($options['base_uri']);
        }
        if (isset($options['headers'])) {
            $options['defaults']['headers'] = $options['headers'];
            unset($options['headers']);
        }
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

    public function setLogger(LoggerInterface $logger, $logLevel = LogLevel::INFO, $formatter = null)
    {
        $this->logger = $logger;
        if ($logger instanceof LoggerInterface) {
            $this->getEmitter()->attach(new LogSubscriber($logger, $formatter, $logLevel));
        }
    }

    public function addHandler($handler)
    {
        $this->getEmitter()->attach($handler);
    }

    public function setCorrelationIdProvider(CorrelationIdProvider $provider)
    {
        $this->addHandler(new CorrelationIdSubscriber($provider));
    }

    public function setOAuthTokenProvider(TokenProvider $tokenProvider)
    {
        $this->addHandler(new TokenSubscriber($tokenProvider));
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
     * @throws \Commercetools\Core\Error\ApiException
     * @throws \Commercetools\Core\Error\BadGatewayException
     * @throws \Commercetools\Core\Error\ConcurrentModificationException
     * @throws \Commercetools\Core\Error\ErrorResponseException
     * @throws \Commercetools\Core\Error\GatewayTimeoutException
     * @throws \Commercetools\Core\Error\InternalServerErrorException
     * @throws \Commercetools\Core\Error\InvalidTokenException
     * @throws \Commercetools\Core\Error\NotFoundException
     * @throws \Commercetools\Core\Error\ServiceUnavailableException
     */
    public function execute(RequestInterface $request)
    {
        $options = [
            'headers' => $request->getHeaders(),
            'body' => (string)$request->getBody()
        ];

        try {
            $guzzleRequest = $this->client->createRequest($request->getMethod(), (string)$request->getUri(), $options);
            $guzzleResponse = $this->client->send($guzzleRequest);
            $response = $this->packResponse($guzzleResponse);
        } catch (RequestException $exception) {
            $response = $this->packResponse($exception->getResponse());
            throw ApiException::create($request, $response, $exception);
        }

        return $response;
    }

    protected function packResponse(\GuzzleHttp\Message\ResponseInterface $response = null)
    {
        if (!$response instanceof \GuzzleHttp\Message\ResponseInterface) {
            return null;
        }
        return new Response(
            $response->getStatusCode(),
            $response->getHeaders(),
            (string)$response->getBody()
        );
    }

    /**
     * @param RequestInterface[] $requests
     * @return \Psr\Http\Message\ResponseInterface[]
     * @throws \Commercetools\Core\Error\ApiException
     * @throws \Commercetools\Core\Error\BadGatewayException
     * @throws \Commercetools\Core\Error\ConcurrentModificationException
     * @throws \Commercetools\Core\Error\ErrorResponseException
     * @throws \Commercetools\Core\Error\GatewayTimeoutException
     * @throws \Commercetools\Core\Error\InternalServerErrorException
     * @throws \Commercetools\Core\Error\InvalidTokenException
     * @throws \Commercetools\Core\Error\NotFoundException
     * @throws \Commercetools\Core\Error\ServiceUnavailableException
     */
    public function executeBatch(array $requests)
    {
        $results = Pool::batch(
            $this->client,
            $this->getBatchHttpRequests($requests)
        );

        $responses = [];
        foreach ($results as $key => $result) {
            if (!$result instanceof RequestException) {
                $response = $this->packResponse($result);
            } else {
                $httpResponse = $this->packResponse($result->getResponse());
                $request = $requests[$key];
                $response = ApiException::create($request, $httpResponse, $result);
            }
            $responses[$key] = $response;
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
            'body' => $formParams,
            'auth' => [$clientId, $clientSecret]
        ];

        try {
            $response = $this->client->post($oauthUri, $options);
        } catch (RequestException $exception) {
            $authRequest = $exception->getRequest();
            $request = new Request(
                $authRequest->getMethod(),
                $authRequest->getUrl(),
                $authRequest->getHeaders(),
                (string)$authRequest->getBody()
            );
            $response = $this->packResponse($exception->getResponse());
            throw ApiException::create($request, $response, $exception);
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

    public static function getAdapterInfo()
    {
        return 'GuzzleHttp/' . Client::VERSION;
    }
}
