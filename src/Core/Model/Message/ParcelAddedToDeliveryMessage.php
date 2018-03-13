<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\Parcel;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parceladdedtodelivery-message
 * @method string getId()
 * @method ParcelAddedToDeliveryMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelAddedToDeliveryMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ParcelAddedToDeliveryMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelAddedToDeliveryMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelAddedToDeliveryMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelAddedToDeliveryMessage setType(string $type = null)
 * @method Delivery getDelivery()
 * @method ParcelAddedToDeliveryMessage setDelivery(Delivery $delivery = null)
 * @method Parcel getParcel()
 * @method ParcelAddedToDeliveryMessage setParcel(Parcel $parcel = null)
 * @method int getVersion()
 * @method ParcelAddedToDeliveryMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ParcelAddedToDeliveryMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class ParcelAddedToDeliveryMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelAddedToDelivery';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['delivery'] = [static::TYPE => Delivery::class];
        $definitions['parcel'] = [static::TYPE => Parcel::class];

        return $definitions;
    }
}
