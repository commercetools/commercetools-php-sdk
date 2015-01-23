<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 14:35
 */

namespace Sphere\Core\Http;


abstract class AbstractRequest implements ClientRequest, HttpRequestInterface
{
    protected $httpMethod;
    protected $path;
    protected $body;
    protected $headers;

    public function __construct($method, $path)
    {
        $this->httpMethod = $method;
        $this->path = $path;
        $this->headers = [];
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

    /**
     * @return $this
     */
    public function httpRequest()
    {
        return $this;
    }

    public static function of($method, $path, $body = null, $contentType = null)
    {
        if (!is_null($contentType)) {
            return FileRequest::of($method, $path, $body, $contentType);
        }
        if (!is_null($body)) {
            return JsonRequest::of($method, $path, $body);
        }
        return HttpRequest::of($method, $path);
    }
}
