<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class DeliveryItem
 * @package Sphere\Core\Model\Order
 * @method string getId()
 * @method DeliveryItem setId(string $id)
 * @method int getQuantity()
 * @method DeliveryItem setQuantity(int $quantity)
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
