<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * Class DeliveryItemCollection
 * @package Sphere\Core\Model\Order
 * @method DeliveryItem current()
 * @method DeliveryItem getAt($offset)
 */
class DeliveryItemCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\DeliveryItem';
}
