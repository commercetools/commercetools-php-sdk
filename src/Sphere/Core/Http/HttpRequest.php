<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:02
 */

namespace Sphere\Core\Http;


class HttpRequest extends AbstractRequest
{
    /**
     * @param $method
     * @param $path
     * @param null $body
     * @param null $contentType
     * @return HttpRequestInterface
     */
    public static function of($method, $path, $body = null, $contentType = null)
    {
        return new static($method, $path);
    }

}
