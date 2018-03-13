<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#trackingdata
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
    public function fieldDefinitions()
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
