<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#return-info
 * @method ReturnInfo current()
 * @method ReturnInfoCollection add(ReturnInfo $element)
 * @method ReturnInfo getAt($offset)
 */
class ReturnInfoCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ReturnInfo';
}
