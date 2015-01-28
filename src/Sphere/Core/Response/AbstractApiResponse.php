<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:44
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Http\ApiResponseInterface;
use Sphere\Core\Http\ClientRequestInterface;

abstract class AbstractApiResponse implements ApiResponseInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var ClientRequestInterface
     */
    protected $request;

    public function __construct(ResponseInterface $response, ClientRequestInterface $request)
    {
        $this->response = $response;
    }

    public function json()
    {
        return $this->response->json();
    }

    public function getBody()
    {
        return $this->response->getBody();
    }

    public function isError()
    {
        $statusCode = $this->response->getStatusCode();

        return ($statusCode == 200);
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return ClientRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
