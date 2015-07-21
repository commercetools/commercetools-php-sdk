<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Zone\ZoneReference;

/**
 * @package Sphere\Core\Model\ShippingMethod
 * @link http://dev.sphere.io/http-api-projects-shippingMethods.html#zone-rate
 * @method ZoneReference getZone()
 * @method ZoneRate setZone(ZoneReference $zone = null)
 * @method ShippingRateCollection getShippingRates()
 * @method ZoneRate setShippingRates(ShippingRateCollection $shippingRates = null)
 */
class ZoneRate extends JsonObject
{
    public function getFields()
    {
        return [
            'zone' => [static::TYPE => '\Sphere\Core\Model\Zone\ZoneReference'],
            'shippingRates' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingRateCollection']
        ];
    }
}
