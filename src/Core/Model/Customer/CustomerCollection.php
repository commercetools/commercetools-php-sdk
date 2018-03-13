<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://docs.commercetools.com/http-api-projects-customers.html#customer
 * @method Customer current()
 * @method CustomerCollection add(Customer $element)
 * @method Customer getAt($offset)
 * @method Customer getById($offset)
 */
class CustomerCollection extends Collection
{
    protected $type = Customer::class;
}
