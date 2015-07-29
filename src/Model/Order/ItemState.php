<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\State\StateReference;

/**
 * @package Sphere\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#item-state
 * @method int getQuantity()
 * @method ItemState setQuantity(int $quantity = null)
 * @method StateReference getState()
 * @method ItemState setState(StateReference $state = null)
 */
class ItemState extends JsonObject
{
    public function getFields()
    {
        return [
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Sphere\Core\Model\State\StateReference'],
        ];
    }
}
