<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#delivery
 * @method string getId()
 * @method Delivery setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Delivery setCreatedAt(\DateTime $createdAt = null)
 * @method DeliveryItemCollection getItems()
 * @method Delivery setItems(DeliveryItemCollection $items = null)
 * @method ParcelCollection getParcels()
 * @method Delivery setParcels(ParcelCollection $parcels = null)
 */
class Delivery extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'items' => [static::TYPE => '\Commercetools\Core\Model\Order\DeliveryItemCollection'],
            'parcels' => [static::TYPE => '\Commercetools\Core\Model\Order\ParcelCollection'],
        ];
    }
}
