<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method ReturnItem current()
 * @method ReturnItemCollection add(ReturnItem $element)
 * @method ReturnItem getAt($offset)
 */
class ReturnItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ReturnItem';
}
