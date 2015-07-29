<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#delivery
 * @method string getId()
 * @method Delivery setId(string $id = null)
 * @method \DateTime getCreatedAt()
 * @method Delivery setCreatedAt(\DateTime $createdAt = null)
 * @method DeliveryItemCollection getItems()
 * @method Delivery setItems(DeliveryItemCollection $items = null)
 * @method ParcelCollection getParcels()
 * @method Delivery setParcels(ParcelCollection $parcels = null)
 */
class Delivery extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'items' => [static::TYPE => '\Sphere\Core\Model\Order\DeliveryItemCollection'],
            'parcels' => [static::TYPE => '\Sphere\Core\Model\Order\ParcelCollection'],
        ];
    }
}
