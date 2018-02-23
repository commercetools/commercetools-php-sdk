<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#shippingrate
 * @method ShippingRate current()
 * @method ShippingRateCollection add(ShippingRate $element)
 * @method ShippingRate getAt($offset)
 */
class ShippingRateCollection extends ShippingRateDraftCollection
{
    protected $type = ShippingRate::class;
}
