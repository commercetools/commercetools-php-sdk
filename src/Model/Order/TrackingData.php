<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#tracking-data
 * @method string getTrackingId()
 * @method TrackingData setTrackingId(string $trackingId = null)
 * @method string getCarrier()
 * @method TrackingData setCarrier(string $carrier = null)
 * @method string getProvider()
 * @method TrackingData setProvider(string $provider = null)
 * @method string getProviderTransaction()
 * @method TrackingData setProviderTransaction(string $providerTransaction = null)
 * @method bool getIsReturn()
 * @method TrackingData setIsReturn(bool $isReturn = null)
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
