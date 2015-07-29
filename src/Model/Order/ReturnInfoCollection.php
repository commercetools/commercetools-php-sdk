<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Order
 * @method ReturnInfo current()
 * @method ReturnInfo getAt($offset)
 */
class ReturnInfoCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\ReturnInfo';
}
