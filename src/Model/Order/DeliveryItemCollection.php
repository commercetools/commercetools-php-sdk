<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#delivery-item
 * @method DeliveryItem current()
 * @method DeliveryItemCollection add(DeliveryItem $element)
 * @method DeliveryItem getAt($offset)
 */
class DeliveryItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\DeliveryItem';
}
