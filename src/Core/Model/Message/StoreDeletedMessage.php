<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Channel\ChannelReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/api/message-types#storedeletedmessage
 * @method string getId()
 * @method StoreDeletedMessage setId(string $id = null)
 * @method int getVersion()
 * @method StoreDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method StoreDeletedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method StoreDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method StoreDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method StoreDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method StoreDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method StoreDeletedMessage setType(string $type = null)
 * @method string getSku()
 * @method StoreDeletedMessage setSku(string $sku = null)
 * @method ChannelReference getSupplyChannel()
 * @method StoreDeletedMessage setSupplyChannel(ChannelReference $supplyChannel = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method StoreDeletedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class StoreDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'StoreDeleted';

    public function fieldDefinitions()
    {
        return parent::fieldDefinitions();
    }
}
