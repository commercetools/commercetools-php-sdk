<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Order
 * 
 * @method Parcel current()
 * @method Parcel getAt($offset)
 */
class ParcelCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Order\Parcel';
}
