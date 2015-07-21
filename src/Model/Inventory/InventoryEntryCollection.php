<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Inventory;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Inventory
 * 
 * @method InventoryEntry current()
 * @method InventoryEntry getAt($offset)
 */
class InventoryEntryCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Inventory\InventoryEntry';
}
