<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:09
 */

namespace Sphere\Core\Http;


class JsonRequest extends AbstractRequest
{
    public function __construct($method, $path, $body)
    {
        parent::__construct($method, $path);
        $this->body = $body;
    }

    /**
     * @param $method
     * @param $path
     * @param null $body
     * @param null $contentType
     * @return static
     */
    public static function of($method, $path, $body = null, $contentType = null)
    {
        return new static($method, $path, $body);
    }

}
