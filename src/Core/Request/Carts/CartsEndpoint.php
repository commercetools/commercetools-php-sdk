<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Client\JsonEndpoint;

class CartsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('carts');
    }
}
