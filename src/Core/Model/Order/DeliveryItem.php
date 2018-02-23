<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#deliveryitem
 * @method string getId()
 * @method DeliveryItem setId(string $id = null)
 * @method int getQuantity()
 * @method DeliveryItem setQuantity(int $quantity = null)
 */
class DeliveryItem extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'quantity' => [static::TYPE => 'int'],
        ];
    }
}
