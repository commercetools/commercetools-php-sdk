<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Inventory
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#inventory-entry
 * @method InventoryEntry current()
 * @method InventoryEntryCollection add(InventoryEntry $element)
 * @method InventoryEntry getAt($offset)
 */
class InventoryEntryCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Inventory\InventoryEntry';
}
