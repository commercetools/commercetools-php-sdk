<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#cartdiscount
 * @method string getTypeId()
 * @method CartDiscountReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartDiscountReference setId(string $id = null)
 * @method CartDiscount getObj()
 * @method CartDiscountReference setObj(CartDiscount $obj = null)
 * @method string getKey()
 * @method CartDiscountReference setKey(string $key = null)
 */
class CartDiscountReference extends Reference
{
    const TYPE_CART_DISCOUNT = 'cart-discount';
    const TYPE_CLASS = CartDiscount::class;

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
