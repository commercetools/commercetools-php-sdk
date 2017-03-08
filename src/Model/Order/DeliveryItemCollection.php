<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#deliveryitem
 * @method DeliveryItem current()
 * @method DeliveryItemCollection add(DeliveryItem $element)
 * @method DeliveryItem getAt($offset)
 * @method DeliveryItem getById($offset)
 */
class DeliveryItemCollection extends Collection
{
    protected $type = DeliveryItem::class;

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof DeliveryItem) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }
}
