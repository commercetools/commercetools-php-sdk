<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Orders
 */
class OrdersEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('orders');
    }
}
