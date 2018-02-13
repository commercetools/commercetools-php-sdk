<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Inventory
 * @link https://docs.commercetools.com/http-api-projects-inventory.html#inventoryentry
 * @method InventoryEntry current()
 * @method InventoryEntryCollection add(InventoryEntry $element)
 * @method InventoryEntry getAt($offset)
 * @method InventoryEntry getById($offset)
 */
class InventoryEntryCollection extends Collection
{
    protected $type = InventoryEntry::class;
}
