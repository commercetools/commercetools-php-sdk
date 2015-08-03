<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Model\Inventory
 * @method string getId()
 * @method InventoryEntry setId(string $id = null)
 * @method int getVersion()
 * @method InventoryEntry setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method InventoryEntry setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method InventoryEntry setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getSku()
 * @method InventoryEntry setSku(string $sku = null)
 * @method ChannelReference getSupplyChannel()
 * @method InventoryEntry setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method int getQuantityOnStock()
 * @method InventoryEntry setQuantityOnStock(int $quantityOnStock = null)
 * @method int getAvailableQuantity()
 * @method InventoryEntry setAvailableQuantity(int $availableQuantity = null)
 * @method int getRestockableInDays()
 * @method InventoryEntry setRestockableInDays(int $restockableInDays = null)
 * @method \DateTime getExpectedDelivery()
 * @method InventoryEntry setExpectedDelivery(\DateTime $expectedDelivery = null)
 */
class InventoryEntry extends Resource
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'sku' => [static::TYPE => 'string'],
            'supplyChannel' => [static::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            'quantityOnStock' => [static::TYPE => 'int'],
            'availableQuantity' => [static::TYPE => 'int'],
            'restockableInDays' => [static::TYPE => 'int'],
            'expectedDelivery' => [static::TYPE => '\DateTime'],
        ];
    }
}
