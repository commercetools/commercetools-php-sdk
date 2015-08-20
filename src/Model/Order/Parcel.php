<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#parcel
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
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'measurements' => [static::TYPE => '\Commercetools\Core\Model\Order\ParcelMeasurements'],
            'trackingData' => [static::TYPE => '\Commercetools\Core\Model\Order\TrackingData'],
        ];
    }
}
