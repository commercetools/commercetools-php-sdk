<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * Class SyncInfoCollection
 * @package Sphere\Core\Model\Order
 * @method SyncInfo current()
 * @method SyncInfo getAt($offset)
 */
class SyncInfoCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\SyncInfo';
}
