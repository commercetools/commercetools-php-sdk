<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:09
 */

namespace Sphere\Core\Http;


class JsonRequest extends HttpRequest
{
    public function __construct($method, $path, $body)
    {
        parent::__construct($method, $path, $body, 'application/json');
    }
}
