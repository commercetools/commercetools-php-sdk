<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * Class OrderCollection
 * @package Sphere\Core\Model\Order
 * @method Order current()
 * @method Order getAt($offset)
 */
class OrderCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\Order';
}
