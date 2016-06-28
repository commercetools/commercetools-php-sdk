<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\CartDiscount\CartDiscountReference;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://dev.commercetools.com/http-api-projects-carts.html#discountedlineitemportion
 * @method CartDiscountReference getDiscount()
 * @method DiscountedLineItemPortion setDiscount(CartDiscountReference $discount = null)
 * @method Money getDiscountedAmount()
 * @method DiscountedLineItemPortion setDiscountedAmount(Money $discountedAmount = null)
 */
class DiscountedLineItemPortion extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'discount' => [static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscountReference'],
            'discountedAmount' => [static::TYPE => '\Commercetools\Core\Model\Common\Money']
        ];
    }
}
