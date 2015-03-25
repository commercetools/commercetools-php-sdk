<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class OrdersEndpoint
 * @package Sphere\Core\Request\Orders
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
