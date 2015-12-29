<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:17
 */

namespace Commercetools\Core\Request\Customers;

use Commercetools\Core\Client\JsonEndpoint;

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
