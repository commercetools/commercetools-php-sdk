<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:13
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductDiscount\ProductDiscountReference;

/**
 * @package Commercetools\Core\Model\Common
 * @link http://dev.commercetools.com/http-api-projects-products.html#discounted-price
 * @method Money getValue()
 * @method ProductDiscountReference getDiscount()
 * @method DiscountedPrice setValue(Money $value = null)
 * @method DiscountedPrice setDiscount(ProductDiscountReference $discount = null)
 */
class DiscountedPrice extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'value' => [self::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'discount' => [self::TYPE => '\Commercetools\Core\Model\ProductDiscount\ProductDiscountReference'],
        ];
    }


    /**
     * @param Money $value
     * @param ProductDiscountReference $discount
     * @param Context|callable $context
     * @return DiscountedPrice
     */
    public static function ofMoneyAndDiscount(Money $value, ProductDiscountReference $discount, $context = null)
    {
        $price = static::of($context);
        return $price->setValue($value)->setDiscount($discount);
    }
}
