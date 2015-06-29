<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CartDiscount;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * Class CartDiscountReference
 * @package Sphere\Core\Model\CartDiscount
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method CartDiscountReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartDiscountReference setId(string $id = null)
 * @method CartDiscount getObj()
 * @method CartDiscountReference setObj(CartDiscount $obj = null)
 */
class CartDiscountReference extends Reference
{
    const TYPE_CART_DISCOUNT = 'cart-discount';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscount'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return CartDiscountReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CART_DISCOUNT, $id, $context);
    }
}
