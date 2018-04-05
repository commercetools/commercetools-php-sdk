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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parcelremovedfromdelivery-message
 * @method string getId()
 * @method ParcelRemovedFromDeliveryMessage setId(string $id = null)
 * @method int getVersion()
 * @method ParcelRemovedFromDeliveryMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelRemovedFromDeliveryMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ParcelRemovedFromDeliveryMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ParcelRemovedFromDeliveryMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelRemovedFromDeliveryMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelRemovedFromDeliveryMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelRemovedFromDeliveryMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method ParcelRemovedFromDeliveryMessage setDeliveryId(string $deliveryId = null)
 * @method Parcel getParcel()
 * @method ParcelRemovedFromDeliveryMessage setParcel(Parcel $parcel = null)
 */
class ParcelRemovedFromDeliveryMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelRemovedFromDelivery';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcel'] = [static::TYPE => Parcel::class];

        return $definitions;
    }
}
