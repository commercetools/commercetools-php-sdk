<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:07
 */

namespace Sphere\Core\Http;


class FileRequest extends AbstractRequest
{
    public function __construct($method, $path, $body, $contentType)
    {
        parent::__construct($method, $path);
        $this->body = $body;
        $this->headers = [
            "Content-Type" => $contentType
        ];
    }

    /**
     * @param $method
     * @param $path
     * @param $body
     * @param $contentType
     * @return static
     */
    public static function of($method, $path, $body = null, $contentType = null)
    {
        return new static($method, $path, $body, $contentType);
    }

}
