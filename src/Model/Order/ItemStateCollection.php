<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Order
 * @method ItemState current()
 * @method ItemState getAt($offset)
 */
class ItemStateCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\ItemState';
}
