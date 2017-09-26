<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use Commercetools\Core\Client\OAuth\TokenProvider;
use Commercetools\Core\Helper\CorrelationIdProvider;
use Commercetools\Core\Response\AbstractApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Pool;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Error\ApiException;
use Psr\Log\LogLevel;

class Guzzle6Adapter implements AdapterOptionInterface, CorrelationIdAware, TokenProviderAware
{
    const DEFAULT_CONCURRENCY = 25;
    /**
     * @var Client
     */
    protected $client;

    protected $logger;

    private $concurrency;

    public function __construct(array $options = [])
    {
        $options = array_merge(
            [
                'allow_redirects' => false,
                'verify' => true,
                'timeout' => 60,
                'connect_timeout' => 10,
                'concurrency' => self::DEFAULT_CONCURRENCY
            ],
            $options
        );
        $this->concurrency = $options['concurrency'];
        $this->client = new Client($options);
    }

    public function setLogger(LoggerInterface $logger, $logLevel = LogLevel::INFO, $formatter = null)
    {
        if (is_null($formatter)) {
            $formatter = new MessageFormatter();
        }
        $this->logger = $logger;
        $this->addHandler(self::log($logger, $formatter, $logLevel));
    }

    public function setCorrelationIdProvider(CorrelationIdProvider $provider)
    {
        $this->addHandler(Middleware::mapRequest(function (RequestInterface $request) use ($provider) {
            return $request->withAddedHeader(
                AbstractApiResponse::X_CORRELATION_ID,
                $provider->getCorrelationId()
            );
        }));
    }

    public function setOAuthTokenProvider(TokenProvider $tokenProvider)
    {
        $this->addHandler(Middleware::mapRequest(function (RequestInterface $request) use ($tokenProvider) {
            return $request->withAddedHeader(
                'Authorization',
                'Bearer ' . $tokenProvider->getToken()->getToken()
            );
        }));
    }

    /**
     * Middleware that logs requests, responses, and errors using a message
     * formatter.
     *
     * @param LoggerInterface  $logger Logs messages.
     * @param MessageFormatter $formatter Formatter used to create message strings.
     * @param string           $logLevel Level at which to log requests.
     *
     * @return callable Returns a function that accepts the next handler.
     */
    private static function log(LoggerInterface $logger, MessageFormatter $formatter, $logLevel = LogLevel::INFO)
    {
        return function (callable $handler) use ($logger, $formatter, $logLevel) {
            return function ($request, array $options) use ($handler, $logger, $formatter, $logLevel) {
                return $handler($request, $options)->then(
                    function ($response) use ($logger, $request, $formatter, $logLevel) {
                        $message = $formatter->format($request, $response);
                        $context = [
                            AbstractApiResponse::X_CORRELATION_ID => $response->getHeader(
                                AbstractApiResponse::X_CORRELATION_ID
                            )
                        ];
                        $logger->log($logLevel, $message, $context);
                        return $response;
                    },
                    function ($reason) use ($logger, $request, $formatter) {
                        $response = null;
                        $context = [];
                        if ($reason instanceof RequestException) {
                            $response = $reason->getResponse();
                            if (!is_null($response)) {
                                $context[AbstractApiResponse::X_CORRELATION_ID] = $response->getHeader(
                                    AbstractApiResponse::X_CORRELATION_ID
                                );
                            }
                        }
                        $message = $formatter->format($request, $response, $reason);
                        $logger->notice($message, $context);
                        return \GuzzleHttp\Promise\rejection_for($reason);
                    }
                );
            };
        };
    }

    public function addHandler($handler)
    {
        $this->client->getConfig('handler')->push($handler);
    }

    /**
     * @param RequestInterface $request
     * @param array $clientOptions
     * @return ResponseInterface
     * @throws ApiException
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
    public function execute(RequestInterface $request, array $clientOptions = [])
    {
        try {
            $response = $this->client->send($request, $clientOptions);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            throw ApiException::create($request, $response, $exception);
        }

        return $response;
    }

    /**
     * @param RequestInterface[] $requests
     * @param array $clientOptions
     * @return ResponseInterface[]
     */
    public function executeBatch(array $requests, array $clientOptions = [])
    {
        $results = Pool::batch(
            $this->client,
            $requests,
            [
                'concurrency' => $this->concurrency,
                'options' => $clientOptions
            ]
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
     * @param array $clientOptions
     * @return AdapterPromiseInterface
     */
    public function executeAsync(RequestInterface $request, array $clientOptions = [])
    {
        $guzzlePromise = $this->client->sendAsync($request, $clientOptions);

        return new Guzzle6Promise($guzzlePromise);
    }

    public static function getAdapterInfo()
    {
        return 'GuzzleHttp/' . Client::VERSION;
    }
}
