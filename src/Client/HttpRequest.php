<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:02
 */

namespace Sphere\Core\Client;

/**
 * Class HttpRequest
 * @package Sphere\Core\Http
 * @internal
 */
class HttpRequest implements HttpRequestInterface
{
    protected $httpMethod;
    protected $path;
    protected $body;
    protected $headers;

    public function __construct($method, $path, $body = null, $contentType = 'application/json')
    {
        $this->httpMethod = $method;
        $this->path = $path;
        $this->body = $body;
        $this->headers = [
            "Content-Type" => $contentType
        ];
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }


    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
