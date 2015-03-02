<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class TrackingData
 * @package Sphere\Core\Model\Order
 * @method string getTrackingId()
 * @method TrackingData setTrackingId(string $trackingId)
 * @method string getCarrier()
 * @method TrackingData setCarrier(string $carrier)
 * @method string getProvider()
 * @method TrackingData setProvider(string $provider)
 * @method string getProviderTransaction()
 * @method TrackingData setProviderTransaction(string $providerTransaction)
 * @method bool getIsReturn()
 * @method TrackingData setIsReturn(bool $isReturn)
 */
class TrackingData extends JsonObject
{
    public function getFields()
    {
        return [
            'trackingId' => [static::TYPE => 'string'],
            'carrier' => [static::TYPE => 'string'],
            'provider' => [static::TYPE => 'string'],
            'providerTransaction' => [static::TYPE => 'string'],
            'isReturn' => [static::TYPE => 'bool'],
        ];
    }
}
