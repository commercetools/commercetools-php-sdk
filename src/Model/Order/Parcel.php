<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class Parcel
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#parcel
 * @method string getId()
 * @method Parcel setId(string $id = null)
 * @method \DateTime getCreatedAt()
 * @method Parcel setCreatedAt(\DateTime $createdAt = null)
 * @method ParcelMeasurements getMeasurements()
 * @method Parcel setMeasurements(ParcelMeasurements $measurements = null)
 * @method TrackingData getTrackingData()
 * @method Parcel setTrackingData(TrackingData $trackingData = null)
 */
class Parcel extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'measurements' => [static::TYPE => '\Sphere\Core\Model\Order\ParcelMeasurements'],
            'trackingData' => [static::TYPE => '\Sphere\Core\Model\Order\TrackingData'],
        ];
    }
}
