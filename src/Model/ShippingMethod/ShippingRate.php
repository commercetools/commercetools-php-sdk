<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;

/**
 * @package Sphere\Core\Model\ShippingMethod
 * @apidoc http://dev.sphere.io/http-api-projects-shippingMethods.html#shipping-rate
 * @method Money getPrice()
 * @method ShippingRate setPrice(Money $price = null)
 * @method Money getFreeAbove()
 * @method ShippingRate setFreeAbove(Money $freeAbove = null)
 */
class ShippingRate extends JsonObject
{
    public function getFields()
    {
        return [
            'price' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
            'freeAbove' => [static::TYPE => '\Sphere\Core\Model\Common\Money'],
        ];
    }
}
