<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
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

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscount'];

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
