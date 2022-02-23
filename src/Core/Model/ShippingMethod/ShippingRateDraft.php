<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingratedraft
 * @method Money getPrice()
 * @method ShippingRateDraft setPrice(Money $price = null)
 * @method Money getFreeAbove()
 * @method ShippingRateDraft setFreeAbove(Money $freeAbove = null)
 * @method ShippingRatePriceTierCollection getTiers()
 * @method ShippingRateDraft setTiers(ShippingRatePriceTierCollection $tiers = null)
 */
class ShippingRateDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'price' => [static::TYPE => Money::class],
            'freeAbove' => [static::TYPE => Money::class, static::OPTIONAL => true],
            'tiers' => [static::TYPE => ShippingRatePriceTierCollection::class, static::OPTIONAL => true]
        ];
    }

    /**
     * @param Money $price
     * @param Context|callable $context
     * @return ShippingRateDraft
     */
    public static function ofPrice(Money $price, $context = null)
    {
        return static::of($context)->setPrice($price);
    }
}
