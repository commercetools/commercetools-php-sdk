<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method string getId()
 * @method InventoryEntryCreatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method InventoryEntryCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method InventoryEntryCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method InventoryEntryCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method InventoryEntryCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method InventoryEntryCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method InventoryEntryCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method InventoryEntryCreatedMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method InventoryEntryCreatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method InventoryEntry getInventoryEntry()
 * @method InventoryEntryCreatedMessage setInventoryEntry(InventoryEntry $inventoryEntry = null)
 */
class InventoryEntryCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'InventoryEntryCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['inventoryEntry'] = [static::TYPE => InventoryEntry::class];

        return $definitions;
    }
}
