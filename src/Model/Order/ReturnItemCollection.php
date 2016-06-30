<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#returnitem
 * @method ReturnItem current()
 * @method ReturnItemCollection add(ReturnItem $element)
 * @method ReturnItem getAt($offset)
 */
class ReturnItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ReturnItem';

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof ReturnItem) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
