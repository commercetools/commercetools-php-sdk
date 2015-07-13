<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Error;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SphereException extends \Exception
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
        \Exception $previous = null
    ) {
        $code = $response ? $response->getStatusCode() : 0;
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
    }

    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null
    ) {
        if (is_null($response)) {
            return new self('Error completing request', $request, null, $previous);
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
                return new InvalidClientCredentialsException($message, $request, $response, $previous);
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
}
