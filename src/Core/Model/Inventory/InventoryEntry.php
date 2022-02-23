<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Inventory;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Inventory
 * @link https://docs.commercetools.com/http-api-projects-inventory.html#inventoryentry
 * @method string getId()
 * @method InventoryEntry setId(string $id = null)
 * @method int getVersion()
 * @method InventoryEntry setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method InventoryEntry setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method InventoryEntry setLastModifiedAt(DateTime $lastModifiedAt = null)
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
 * @method DateTimeDecorator getExpectedDelivery()
 * @method InventoryEntry setExpectedDelivery(DateTime $expectedDelivery = null)
 * @method CustomFieldObject getCustom()
 * @method InventoryEntry setCustom(CustomFieldObject $custom = null)
 * @method CreatedBy getCreatedBy()
 * @method InventoryEntry setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method InventoryEntry setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 */
class InventoryEntry extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'sku' => [static::TYPE => 'string'],
            'supplyChannel' => [static::TYPE => ChannelReference::class, static::OPTIONAL => true],
            'quantityOnStock' => [static::TYPE => 'int'],
            'availableQuantity' => [static::TYPE => 'int'],
            'restockableInDays' => [static::TYPE => 'int', static::OPTIONAL => true],
            'expectedDelivery' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
