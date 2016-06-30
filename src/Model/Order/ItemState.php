<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#itemstate
 * @method int getQuantity()
 * @method ItemState setQuantity(int $quantity = null)
 * @method StateReference getState()
 * @method ItemState setState(StateReference $state = null)
 */
class ItemState extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'quantity' => [static::TYPE => 'int'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }
}
