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
use Commercetools\Core\Model\Order\ParcelMeasurements;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parcelmeasurementsupdated-message
 * @method string getId()
 * @method ParcelMeasurementsUpdatedMessage setId(string $id = null)
 * @method int getVersion()
 * @method ParcelMeasurementsUpdatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelMeasurementsUpdatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ParcelMeasurementsUpdatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method ParcelMeasurementsUpdatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelMeasurementsUpdatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelMeasurementsUpdatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelMeasurementsUpdatedMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method ParcelMeasurementsUpdatedMessage setDeliveryId(string $deliveryId = null)
 * @method string getParcelId()
 * @method ParcelMeasurementsUpdatedMessage setParcelId(string $parcelId = null)
 * @method ParcelMeasurements getMeasurements()
 * @method ParcelMeasurementsUpdatedMessage setMeasurements(ParcelMeasurements $measurements = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ParcelMeasurementsUpdatedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ParcelMeasurementsUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelMeasurementsUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcelId'] = [static::TYPE => 'string'];
        $definitions['measurements'] = [static::TYPE => ParcelMeasurements::class, static::OPTIONAL => true];

        return $definitions;
    }
}
