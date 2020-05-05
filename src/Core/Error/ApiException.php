<?php

namespace Commercetools\Core\Error;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Base exception for responses with http status code different than 200 or 201
 * @package Commercetools\Core\Error
 */
class ApiException extends Exception
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(
        $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        Exception $previous = null
    ) {
        $code = $response ? $response->getStatusCode() : ($previous ? $previous->getCode() : 0);
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param Exception|null $previous
     */
    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
        Exception $previous = null
    ) {
        if (is_null($response)) {
            $message = $previous ? 'Error completing request: ' . $previous->getMessage() : "Error completing request";
            return new self($message, $request, null, $previous);
        }

        $level = floor($response->getStatusCode() / 100);
        if ($level == 4) {
            $label = 'Client error response';
        } elseif ($level == 5) {
            $label = 'Server error response';
        } else {
            $label = 'Unsuccessful response';
        }

        $message = $label . ' [url] ' . $request->getUri()
             . ' [status code] ' . $response->getStatusCode()
             . ' [reason phrase] ' . $response->getReasonPhrase();

        switch ($response->getStatusCode()) {
            case 400:
                return new ErrorResponseException($message, $request, $response, $previous);
            case 401:
                if (strpos((string)$response->getBody(), 'invalid_token') !== false) {
                    return new InvalidTokenException($message, $request, $response, $previous);
                }
                return new InvalidClientCredentialsException($message, $request, $response, $previous);
            case 403:
                return new ForbiddenException($message, $request, $response, $previous);
            case 404:
                return new NotFoundException($message, $request, $response, $previous);
            case 409:
                return new ConcurrentModificationException($message, $request, $response, $previous);
            case 500:
                return new InternalServerErrorException($message, $request, $response, $previous);
            case 502:
                return new BadGatewayException($message, $request, $response, $previous);
            case 503:
                return new ServiceUnavailableException($message, $request, $response, $previous);
            case 504:
                return new GatewayTimeoutException($message, $request, $response, $previous);
        }

        return new self($message, $request, $response, $previous);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    protected function getResponseJson()
    {
        $response = $this->getResponse();
        if ($response instanceof ResponseInterface) {
            $json = json_decode($response->getBody(), true);
            return $json;
        }

        return [];
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $data = $this->getResponseJson();

        return isset($data['errors']) ? $data['errors'] : [];
    }

    /**
     * @return string
     */
    public function getResponseMessage()
    {
        $data = $this->getResponseJson();

        return isset($data['message']) ? $data['message'] : '';
    }

    /**
     * @return string
     */
    public function getResponseStatusCode()
    {
        $data = $this->getResponseJson();

        return isset($data['statusCode']) ? $data['statusCode'] : '';
    }
}
