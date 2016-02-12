<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Zone\ZoneReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link http://dev.commercetools.com/http-api-projects-shippingMethods.html#zone-rate
 * @method ZoneReference getZone()
 * @method ZoneRate setZone(ZoneReference $zone = null)
 * @method ShippingRateCollection getShippingRates()
 * @method ZoneRate setShippingRates(ShippingRateCollection $shippingRates = null)
 */
class ZoneRate extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'zone' => [static::TYPE => '\Commercetools\Core\Model\Zone\ZoneReference'],
            'shippingRates' => [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingRateCollection']
        ];
    }
}
