<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;


use Sphere\Core\Model\Common\JsonObject;

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
