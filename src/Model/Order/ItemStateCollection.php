<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method ItemState current()
 * @method ItemStateCollection add(ItemState $element)
 * @method ItemState getAt($offset)
 */
class ItemStateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ItemState';
}
