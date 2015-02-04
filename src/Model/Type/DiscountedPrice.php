<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 17:13
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Model\ProductDiscount\ProductDiscountReference;

/**
 * Class DiscountedPrice
 * @package Sphere\Core\Model\Type
 * @method static DiscountedPrice of(Money $value, ProductDiscountReference $discount)
 */
class DiscountedPrice extends JsonObject
{
    /**
     * @var Money
     */
    protected $value;

    /**
     * @var ProductDiscountReference
     */
    protected $discount;

    /**
     * @param Money $value
     * @param ProductDiscountReference $discount
     */
    public function __construct(Money $value, ProductDiscountReference $discount)
    {
        $this->value = $value;
        $this->discount = $discount;
    }

    /**
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Money $value
     * @return $this
     */
    public function setValue(Money $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return ProductDiscountReference
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param ProductDiscountReference $discount
     * @return $this
     */
    public function setDiscount(ProductDiscountReference $discount)
    {
        $this->discount = $discount;

        return $this;
    }
}
