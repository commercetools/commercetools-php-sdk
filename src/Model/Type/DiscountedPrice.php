<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:13
 */

namespace Sphere\Core\Model\Type;

use Sphere\Core\Model\OfTrait;
use Sphere\Core\Model\ProductDiscount\ProductDiscountReference;

/**
 * Class DiscountedPrice
 * @package Sphere\Core\Model\Type
 * @method static DiscountedPrice of(Money $value, ProductDiscountReference $discount)
 * @method Money getValue()
 * @method ProductDiscountReference getDiscount()
 * @method DiscountedPrice setValue(Money $value)
 * @method DiscountedPrice setDiscount(ProductDiscountReference $discount)
 */
class DiscountedPrice extends JsonObject
{
    use OfTrait;

    use OfTrait;

    public function getFields()
    {
        return [
            'value' => [self::TYPE => '\Sphere\Core\Model\Type\Money'],
            'discount' => [self::TYPE => '\Sphere\Core\Model\ProductDiscount\ProductDiscountReference'],
        ];
    }

    /**
     * @param Money $value
     * @param ProductDiscountReference $discount
     */
    public function __construct(Money $value, ProductDiscountReference $discount)
    {
        $this->value = $value;
        $this->discount = $discount;
    }
}
