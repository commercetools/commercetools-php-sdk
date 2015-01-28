<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:07
 */

namespace Sphere\Core\Http;


/**
 * Class FileRequest
 * @package Sphere\Core\Http
 */
class FileRequest extends HttpRequest
{
    public function __construct($method, $path, $file, $contentType)
    {
        parent::__construct($method, $path, $file, $contentType);
    }
}
