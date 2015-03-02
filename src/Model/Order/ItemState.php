<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\State\StateReference;

/**
 * Class ItemState
 * @package Sphere\Core\Model\Order
 * @method int getQuantity()
 * @method ItemState setQuantity(int $quantity)
 * @method StateReference getState()
 * @method ItemState setState(StateReference $state)
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
