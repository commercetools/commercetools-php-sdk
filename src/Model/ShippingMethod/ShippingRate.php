<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;

/**
 * Class ShippingRate
 * @package Sphere\Core\Model\ShippingMethod
 * @method Money getPrice()
 * @method ShippingRate setPrice(Money $price)
 * @method Money getFreeAbove()
 * @method ShippingRate setFreeAbove(Money $freeAbove)
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
