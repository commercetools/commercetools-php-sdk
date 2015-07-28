<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:13
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\ProductDiscount\ProductDiscountReference;

/**
 * @package Sphere\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#discounted-price
 * @method Money getValue()
 * @method ProductDiscountReference getDiscount()
 * @method DiscountedPrice setValue(Money $value = null)
 * @method DiscountedPrice setDiscount(ProductDiscountReference $discount = null)
 */
class DiscountedPrice extends JsonObject
{

    public function getFields()
    {
        return [
            'value' => [self::TYPE => '\Sphere\Core\Model\Common\Money'],
            'discount' => [self::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscountReference'],
        ];
    }


    /**
     * @param Money $value
     * @param ProductDiscountReference $discount
     * @param Context|callable $context
     * @return DiscountedPrice
     */
    public function ofMoneyAndDiscount(Money $value, ProductDiscountReference $discount, $context = null)
    {
        $price = static::of($context);
        return $price->setValue($value)->setDiscount($discount);
    }
}
