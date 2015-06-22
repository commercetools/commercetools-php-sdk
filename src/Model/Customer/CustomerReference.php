<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * Class CustomerReference
 * @package Sphere\Core\Model\Customer
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method CustomerReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerReference setId(string $id = null)
 * @method Customer getObj()
 * @method CustomerReference setObj(Customer $obj = null)
 */
class CustomerReference extends Reference
{
    const TYPE_CUSTOMER = 'customer';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\Customer\Customer'];

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
