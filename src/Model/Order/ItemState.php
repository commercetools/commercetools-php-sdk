<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#item-state
 * @method int getQuantity()
 * @method ItemState setQuantity(int $quantity = null)
 * @method StateReference getState()
 * @method ItemState setState(StateReference $state = null)
 */
class ItemState extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }
}
