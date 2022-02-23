<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#parcel
 * @method string getId()
 * @method Parcel setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Parcel setCreatedAt(DateTime $createdAt = null)
 * @method ParcelMeasurements getMeasurements()
 * @method Parcel setMeasurements(ParcelMeasurements $measurements = null)
 * @method TrackingData getTrackingData()
 * @method Parcel setTrackingData(TrackingData $trackingData = null)
 * @method DeliveryItemCollection getItems()
 * @method Parcel setItems(DeliveryItemCollection $items = null)
 * @method CustomFieldObject getCustom()
 * @method Parcel setCustom(CustomFieldObject $custom = null)
 */
class Parcel extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'measurements' => [static::TYPE => ParcelMeasurements::class, static::OPTIONAL => true],
            'trackingData' => [static::TYPE => TrackingData::class, static::OPTIONAL => true],
            'items' => [static::TYPE => DeliveryItemCollection::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
        ];
    }
}
