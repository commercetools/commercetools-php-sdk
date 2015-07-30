<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#delivery-item
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
