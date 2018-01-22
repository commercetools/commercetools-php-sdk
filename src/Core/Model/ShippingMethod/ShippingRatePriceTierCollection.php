<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingratepricetier
 * @method ShippingRatePriceTier current()
 * @method ShippingRatePriceTierCollection add(ShippingRatePriceTier $element)
 * @method ShippingRatePriceTier getAt($offset)
 */
class ShippingRatePriceTierCollection extends ShippingRateDraftCollection
{
    protected $type = ShippingRatePriceTier::class;
}
