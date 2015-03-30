<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class ShippingMethodsEndpoint
 * @package Sphere\Core\Request\ShippingMethods
 */
class ShippingMethodsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('shipping-methods');
    }
}
