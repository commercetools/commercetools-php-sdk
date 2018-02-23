<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\ShippingMethods
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
