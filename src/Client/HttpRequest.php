<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:02
 */

namespace Sphere\Core\Client;

use GuzzleHttp\Psr7\Request;

/**
 * Class HttpRequest
 * @package Sphere\Core\Http
 * @internal
 */
class HttpRequest extends Request
{
    public function __construct($method, $path, $body = null, $contentType = 'application/json')
    {
        $headers = [
            "Content-Type" => $contentType
        ];
        parent::__construct($method, $path, $headers, $body);
    }
}
