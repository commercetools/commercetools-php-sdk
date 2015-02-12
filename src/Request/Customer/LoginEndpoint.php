<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 12.02.15, 15:58
 */

namespace Sphere\Core\Request\Customer;

use Sphere\Core\Client\JsonEndpoint;

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
