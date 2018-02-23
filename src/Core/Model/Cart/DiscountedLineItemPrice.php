<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#discountedlineitemprice
 * @method Money getValue()
 * @method DiscountedLineItemPrice setValue(Money $value = null)
 * @method DiscountedLineItemPortionCollection getIncludedDiscounts()
 * @method DiscountedLineItemPrice setIncludedDiscounts(DiscountedLineItemPortionCollection $includedDiscounts = null)
 */
class DiscountedLineItemPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'value' => [static::TYPE => Money::class],
            'includedDiscounts' => [
                static::TYPE => DiscountedLineItemPortionCollection::class
            ]
        ];
    }
}
