<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method ReturnInfo current()
 * @method ReturnInfoCollection add(ReturnInfo $element)
 * @method ReturnInfo getAt($offset)
 */
class ReturnInfoCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\ReturnInfo';
}
