<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShoppingList;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShoppingList
 *
 * @method ShoppingListCollection add(ShoppingList $element)
 * @method ShoppingList current()
 * @method ShoppingList getAt($offset)
 * @method ShoppingList getById($offset)
 */
class ShoppingListCollection extends Collection
{
    const KEY = 'key';
    protected $type = ShoppingList::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        $key = null;
        if ($row instanceof ShoppingList) {
            $id = $row->getId();
            $key = $row->getKey();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
            $key = isset($row[static::KEY]) ? $row[static::KEY] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::KEY, $offset, $key);
    }
}
