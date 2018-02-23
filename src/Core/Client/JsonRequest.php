<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:09
 */

namespace Commercetools\Core\Client;

/**
 * @package Commercetools\Core\Http
 * @internal
 */
class JsonRequest extends HttpRequest
{
    public function __construct($method, $path, $body)
    {
        if (!is_string($body)) {
            $body = json_encode($body);
        }
        parent::__construct($method, $path, $body, 'application/json');
    }
}
