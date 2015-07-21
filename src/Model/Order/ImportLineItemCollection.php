<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Order
 * @method ImportLineItem current()
 * @method ImportLineItem getAt($offset)
 */
class ImportLineItemCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Order\ImportLineItem';
}
