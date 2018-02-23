<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#returninfo
 * @method ReturnInfo current()
 * @method ReturnInfoCollection add(ReturnInfo $element)
 * @method ReturnInfo getAt($offset)
 */
class ReturnInfoCollection extends Collection
{
    protected $type = ReturnInfo::class;
}
