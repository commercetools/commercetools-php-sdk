<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\Collection;

/**
 * Class CustomerCollection
 * @package Sphere\Core\Model\Customer
 * @method Customer current()
 * @method Customer getAt($offset)
 */
class CustomerCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Customer\Customer';
}
