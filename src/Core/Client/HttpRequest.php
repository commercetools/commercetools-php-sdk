<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:02
 */

namespace Commercetools\Core\Client;

use GuzzleHttp\Psr7\Request;

/**
 * @package Commercetools\Core\Http
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
