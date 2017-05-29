<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#order
 * @method Order current()
 * @method OrderCollection add(Order $element)
 * @method Order getAt($offset)
 * @method Order getById($offset)
 */
class OrderCollection extends Collection
{
    protected $type = Order::class;
}
