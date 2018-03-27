<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#deliveryitemsupdated-message
 * @method string getId()
 * @method DeliveryItemsUpdatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method DeliveryItemsUpdatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DeliveryItemsUpdatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DeliveryItemsUpdatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method DeliveryItemsUpdatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method DeliveryItemsUpdatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method DeliveryItemsUpdatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method DeliveryItemsUpdatedMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method DeliveryItemsUpdatedMessage setDeliveryId(string $deliveryId = null)
 * @method DeliveryItemCollection getItems()
 * @method DeliveryItemsUpdatedMessage setItems(DeliveryItemCollection $items = null)
 */
class DeliveryItemsUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'DeliveryItemsUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['items'] = [static::TYPE => DeliveryItemCollection::class];

        return $definitions;
    }
}
