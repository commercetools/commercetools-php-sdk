<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method Delivery current()
 * @method Delivery getAt($offset)
 */
class DeliveryCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\Delivery';
}
