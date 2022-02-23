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
use Commercetools\Core\Model\Order\TrackingData;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parceltrackingdataupdated-message
 * @method string getId()
 * @method ParcelTrackingDataUpdatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ParcelTrackingDataUpdatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelTrackingDataUpdatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ParcelTrackingDataUpdatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ParcelTrackingDataUpdatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelTrackingDataUpdatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelTrackingDataUpdatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelTrackingDataUpdatedMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method ParcelTrackingDataUpdatedMessage setDeliveryId(string $deliveryId = null)
 * @method string getParcelId()
 * @method ParcelTrackingDataUpdatedMessage setParcelId(string $parcelId = null)
 * @method TrackingData getTrackingData()
 * @method ParcelTrackingDataUpdatedMessage setTrackingData(TrackingData $trackingData = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ParcelTrackingDataUpdatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ParcelTrackingDataUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelTrackingDataUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcelId'] = [static::TYPE => 'string'];
        $definitions['trackingData'] = [static::TYPE => TrackingData::class, static::OPTIONAL => true];

        return $definitions;
    }
}
