<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-customers.html#customer
 * @method string getTypeId()
 * @method CustomerReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerReference setId(string $id = null)
 * @method Customer getObj()
 * @method CustomerReference setObj(Customer $obj = null)
 * @method string getKey()
 * @method CustomerReference setKey(string $key = null)
 */
class CustomerReference extends Reference
{
    const TYPE_CUSTOMER = 'customer';
    const TYPE_CLASS = Customer::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return CustomerReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CUSTOMER, $id, $context);
    }
}
