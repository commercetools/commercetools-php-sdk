<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method CartReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CartReference setId(string $id = null)
 * @method Cart getObj()
 * @method CartReference setObj(Cart $obj = null)
 */
class CartReference extends Reference
{
    const TYPE_CART = 'cart';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Cart\Cart'];

        return $fields;
    }

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
