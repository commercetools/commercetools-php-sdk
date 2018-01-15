<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Zone\ZoneReference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#zoneratedraft
 * @method ZoneReference getZone()
 * @method ZoneRateDraft setZone(ZoneReference $zone = null)
 * @method ShippingRateDraftCollection getShippingRates()
 * @method ZoneRateDraft setShippingRates(ShippingRateDraftCollection $shippingRates = null)
 */
class ZoneRateDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'zone' => [static::TYPE => ZoneReference::class],
            'shippingRates' => [static::TYPE => ShippingRateDraftCollection::class]
        ];
    }
}
