<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @method SyncInfo current()
 * @method SyncInfo getAt($offset)
 */
class SyncInfoCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\SyncInfo';
}
