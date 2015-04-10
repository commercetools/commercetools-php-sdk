<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ZoneRate
 * @package Sphere\Core\Model\ShippingMethod
 * @method Reference getZone()
 * @method ZoneRate setZone(Reference $zone = null)
 * @method ShippingRateCollection getShippingRates()
 * @method ZoneRate setShippingRates(ShippingRateCollection $shippingRates = null)
 */
class ZoneRate extends JsonObject
{
    public function getFields()
    {
        return [
            'zone' => [static::TYPE => 'Reference'],
            'shippingRates' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingRateCollection']
        ];
    }
}
