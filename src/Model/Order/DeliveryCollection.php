<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * Class DeliveryCollection
 * @package Sphere\Core\Model\Order
 * @method Delivery current()
 * @method Delivery getAt($offset)
 */
class DeliveryCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\Delivery';
}
