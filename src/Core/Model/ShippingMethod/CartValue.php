<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#cartvalue
 * @method string getType()
 * @method CartValue setType(string $type = null)
 */
class CartValue extends ShippingRatePriceTier
{
    const INPUT_TYPE = 'CartValue';
}
