<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#sync-info
 * @method SyncInfo current()
 * @method SyncInfoCollection add(SyncInfo $element)
 * @method SyncInfo getAt($offset)
 */
class SyncInfoCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\SyncInfo';
}
