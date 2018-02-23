<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:46
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-customerGroups.html#customergroup
 * @method string getTypeId()
 * @method CustomerGroupReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerGroupReference setId(string $id = null)
 * @method CustomerGroup getObj()
 * @method CustomerGroupReference setObj(CustomerGroup $obj = null)
 * @method string getKey()
 * @method CustomerGroupReference setKey(string $key = null)
 */
class CustomerGroupReference extends Reference
{
    const TYPE_CUSTOMER_GROUP = 'customer-group';
    const TYPE_CLASS = CustomerGroup::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return CustomerGroupReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CUSTOMER_GROUP, $id, $context);
    }
}
