<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#return-item
 * @method ReturnItem current()
 * @method ReturnItemCollection add(ReturnItem $element)
 * @method ReturnItem getAt($offset)
 */
class ReturnItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ReturnItem';
}
