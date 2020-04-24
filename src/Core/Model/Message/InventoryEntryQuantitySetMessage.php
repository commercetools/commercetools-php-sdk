<?php


namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types#inventoryentryquantityset-message
 * @method string getId()
 * @method InventoryEntryQuantitySetMessage setId(string $id = null)
 * @method int getVersion()
 * @method InventoryEntryQuantitySetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method InventoryEntryQuantitySetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method InventoryEntryQuantitySetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method InventoryEntryQuantitySetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method InventoryEntryQuantitySetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method InventoryEntryQuantitySetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method InventoryEntryQuantitySetMessage setType(string $type = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method InventoryEntryQuantitySetMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method int getOldQuantityOnStock()
 * @method InventoryEntryQuantitySetMessage setOldQuantityOnStock(int $oldQuantityOnStock = null)
 * @method int getNewQuantityOnStock()
 * @method InventoryEntryQuantitySetMessage setNewQuantityOnStock(int $newQuantityOnStock = null)
 * @method int getOldAvailableQuantity()
 * @method InventoryEntryQuantitySetMessage setOldAvailableQuantity(int $oldAvailableQuantity = null)
 * @method int getNewAvailableQuantity()
 * @method InventoryEntryQuantitySetMessage setNewAvailableQuantity(int $newAvailableQuantity = null)
 */
class InventoryEntryQuantitySetMessage extends Message
{
    const MESSAGE_TYPE = 'InventoryEntryQuantitySet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['oldQuantityOnStock'] = [static::TYPE => 'int'];
        $definitions['newQuantityOnStock'] = [static::TYPE => 'int'];
        $definitions['oldAvailableQuantity'] = [static::TYPE => 'int'];
        $definitions['newAvailableQuantity'] = [static::TYPE => 'int'];

        return $definitions;
    }
}
