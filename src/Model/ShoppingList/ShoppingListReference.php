<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ShoppingList
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-shopping-lists.html#shopping-list
 * @method string getTypeId()
 * @method ShoppingListReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ShoppingListReference setId(string $id = null)
 * @method ShoppingList getObj()
 * @method ShoppingListReference setObj(ShoppingList $obj = null)
 * @method string getKey()
 * @method ShoppingListReference setKey(string $key = null)
 */
class ShoppingListReference extends Reference
{
    const TYPE_SHOPPING_LIST = 'shopping-list';
    const TYPE_CLASS = '\Commercetools\Core\Model\ShoppingList\ShoppingList';

    /**
     * @param $id
     * @param Context|callable $context
     * @return ShoppingListReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_SHOPPING_LIST, $id, $context);
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return ShoppingListReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_SHOPPING_LIST, $key, $context);
    }
}
