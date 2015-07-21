<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Order
 * @method ReturnItem current()
 * @method ReturnItem getAt($offset)
 */
class ReturnItemCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\ReturnItem';
}
