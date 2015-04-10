<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:13
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\ProductDiscount\ProductDiscountReference;

/**
 * Class DiscountedPrice
 * @package Sphere\Core\Model\Common
 * @method static DiscountedPrice of(Money $value, ProductDiscountReference $discount)
 * @method Money getValue()
 * @method ProductDiscountReference getDiscount()
 * @method DiscountedPrice setValue(Money $value = null)
 * @method DiscountedPrice setDiscount(ProductDiscountReference $discount = null)
 */
class DiscountedPrice extends JsonObject
{
    use OfTrait;

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
     */
    public function __construct(Money $value, ProductDiscountReference $discount, $context = null)
    {
        $this->setContext($context);
        $this->setValue($value);
        $this->setDiscount($discount);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        return new static(
            Money::fromArray($data['value'], $context),
            ProductDiscountReference::fromArray($data['discount'], $context),
            $context
        );
    }
}
