<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Customer
 * @method Customer current()
 * @method CustomerCollection add(Customer $element)
 * @method Customer getAt($offset)
 */
class CustomerCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Customer\Customer';
}
