<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:44
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Http\ClientRequest;

class ApiResponse
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var ClientRequest
     */
    protected $request;

    public function __construct(ResponseInterface $response, ClientRequest $request)
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
     * @return ClientRequest
     */
    public function getRequest()
    {
        return $this->request;
    }
}
