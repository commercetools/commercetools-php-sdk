<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-carts.html#cart
 * @method string getTypeId()
 * @method CartReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartReference setId(string $id = null)
 * @method Cart getObj()
 * @method CartReference setObj(Cart $obj = null)
 * @method string getKey()
 * @method CartReference setKey(string $key = null)
 */
class CartReference extends Reference
{
    const TYPE_CART = 'cart';
    const TYPE_CLASS = Cart::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return CartReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CART, $id, $context);
    }
}
