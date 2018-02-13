<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Zone\ZoneReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#zonerate
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
            'zone' => [static::TYPE => ZoneReference::class],
            'shippingRates' => [static::TYPE => ShippingRateCollection::class]
        ];
    }
}
