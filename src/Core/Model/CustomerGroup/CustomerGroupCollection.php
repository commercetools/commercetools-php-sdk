<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#customergroup
 * @method CustomerGroup current()
 * @method CustomerGroupCollection add(CustomerGroup $element)
 * @method CustomerGroup getAt($offset)
 * @method CustomerGroup getById($offset)
 */
class CustomerGroupCollection extends Collection
{
    protected $type = CustomerGroup::class;
}
