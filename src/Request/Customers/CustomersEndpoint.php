<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Sphere\Core\Request\Customers;


use Sphere\Core\Client\JsonEndpoint;

class CustomersEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('customers');
    }
}
