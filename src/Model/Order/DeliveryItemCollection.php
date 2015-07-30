<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method DeliveryItem current()
 * @method DeliveryItem getAt($offset)
 */
class DeliveryItemCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\DeliveryItem';
}
