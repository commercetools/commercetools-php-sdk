<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\Parcel;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parceltrackingdataupdated-message
 * @method string getId()
 * @method ParcelItemsUpdatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ParcelItemsUpdatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelItemsUpdatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ParcelItemsUpdatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ParcelItemsUpdatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelItemsUpdatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelItemsUpdatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelItemsUpdatedMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method ParcelItemsUpdatedMessage setDeliveryId(string $deliveryId = null)
 * @method string getParcelId()
 * @method ParcelItemsUpdatedMessage setParcelId(string $parcelId = null)
 * @method DeliveryItemCollection getItems()
 * @method ParcelItemsUpdatedMessage setItems(DeliveryItemCollection $items = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ParcelItemsUpdatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ParcelItemsUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelItemsUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcelId'] = [static::TYPE => 'string'];
        $definitions['items'] = [static::TYPE => DeliveryItemCollection::class];

        return $definitions;
    }
}
