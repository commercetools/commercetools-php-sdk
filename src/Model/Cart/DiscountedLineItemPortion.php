<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\CartDiscount\CartDiscountReference;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Money;

/**
 * Class DiscountedLineItemPortion
 * @package Sphere\Core\Model\Cart
 * @method CartDiscountReference getDiscount()
 * @method DiscountedLineItemPortion setDiscount(CartDiscountReference $discount = null)
 * @method Money getDiscountedAmount()
 * @method DiscountedLineItemPortion setDiscountedAmount(Money $discountedAmount = null)
 */
class DiscountedLineItemPortion extends JsonObject
{
    public function getFields()
    {
        return [
            'discount' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountReference'],
            'discountedAmount' => [static::TYPE => '\Sphere\Core\Model\Common\Money']
        ];
    }
}
