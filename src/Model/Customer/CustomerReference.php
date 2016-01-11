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
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
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

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Customer\Customer'];

        return $fields;
    }

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
