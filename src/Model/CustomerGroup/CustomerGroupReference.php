<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:46
 */

namespace Sphere\Core\Model\CustomerGroup;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CustomerGroupReference
 * @package Sphere\Core\Model\CustomerGroup
 * @method static CustomerGroupReference of(string $id)
 * @method string getTypeId()
 * @method CustomerGroupReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerGroupReference setId(string $id = null)
 * @method CustomerGroup getObj()
 * @method CustomerGroupReference setObj(CustomerGroup $obj = null)
 */
class CustomerGroupReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CUSTOMER_GROUP = 'customer-group';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroup']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_CUSTOMER_GROUP, $id, $context);
    }
}
