<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CartDiscountReference
 * @package Sphere\Core\Model\CartDiscount
 * @method string getTypeId()
 * @method CartDiscountReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartDiscountReference setId(string $id = null)
 * @method CartDiscount getObj()
 * @method CartDiscountReference setObj(CartDiscount $obj = null)
 */
class CartDiscountReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CART_DISCOUNT = 'cart-discount';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscount']
        ];
    }

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_CART_DISCOUNT, $id, $context);
    }
}
