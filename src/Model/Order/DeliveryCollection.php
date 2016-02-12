<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#delivery
 * @method Delivery current()
 * @method DeliveryCollection add(Delivery $element)
 * @method Delivery getAt($offset)
 */
class DeliveryCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\Delivery';
}
