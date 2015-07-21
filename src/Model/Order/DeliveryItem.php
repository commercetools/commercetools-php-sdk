<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#delivery-item
 * @method string getId()
 * @method DeliveryItem setId(string $id = null)
 * @method int getQuantity()
 * @method DeliveryItem setQuantity(int $quantity = null)
 */
class DeliveryItem extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }
}
