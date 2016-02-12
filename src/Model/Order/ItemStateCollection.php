<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#item-state
 * @method ItemState current()
 * @method ItemStateCollection add(ItemState $element)
 * @method ItemState getAt($offset)
 */
class ItemStateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ItemState';
}
