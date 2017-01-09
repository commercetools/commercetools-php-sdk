<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Channel\ChannelReference;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#inventoryentrydeleted-message
 * @method string getId()
 * @method InventoryEntryDeletedMessage setId(string $id = null)
 * @method int getVersion()
 * @method InventoryEntryDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method InventoryEntryDeletedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method InventoryEntryDeletedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method InventoryEntryDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method InventoryEntryDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method InventoryEntryDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method InventoryEntryDeletedMessage setType(string $type = null)
 * @method string getSku()
 * @method InventoryEntryDeletedMessage setSku(string $sku = null)
 * @method ChannelReference getSupplyChannel()
 * @method InventoryEntryDeletedMessage setSupplyChannel(ChannelReference $supplyChannel = null)
 */
class InventoryEntryDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'InventoryEntryDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['sku'] = [static::TYPE => 'string'];
        $definitions['supplyChannel'] = [static::TYPE => ChannelReference::class];

        return $definitions;
    }
}
