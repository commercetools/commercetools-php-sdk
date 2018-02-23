<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 12.02.15, 15:58
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\JsonEndpoint;

class LoginEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('login');
    }
}
