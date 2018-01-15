<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingratedraft
 * @method Money getPrice()
 * @method ShippingRateDraft setPrice(Money $price = null)
 * @method Money getFreeAbove()
 * @method ShippingRateDraft setFreeAbove(Money $freeAbove = null)
 */
class ShippingRateDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'price' => [static::TYPE => Money::class],
            'freeAbove' => [static::TYPE => Money::class],
            'tiers' => [static::TYPE => ShippingRate]
        ];
    }
}
