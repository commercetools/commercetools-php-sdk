<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:46
 */

namespace Commercetools\Core\Model\CustomerGroup;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\CustomerGroup
 * @apidoc http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method CustomerGroupReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerGroupReference setId(string $id = null)
 * @method CustomerGroup getObj()
 * @method CustomerGroupReference setObj(CustomerGroup $obj = null)
 */
class CustomerGroupReference extends Reference
{
    const TYPE_CUSTOMER_GROUP = 'customer-group';

    public function getPropertyDefinitions()
    {
        $fields = parent::getPropertyDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroup'];

        return $fields;
    }

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
