<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method Order current()
 * @method OrderCollection add(Order $element)
 * @method Order getAt($offset)
 */
class OrderCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\Order';
}
