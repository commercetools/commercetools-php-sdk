<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class CustomerReference
 * @package Sphere\Core\Model\Customer
 * @method static CustomerReference of(string $id)
 * @method string getTypeId()
 * @method CustomerReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method CustomerReference setId(string $id = null)
 * @method Customer getObj()
 * @method CustomerReference setObj(Customer $obj = null)
 */
class CustomerReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_CUSTOMER = 'customer';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\Customer\Customer']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_CUSTOMER, $id);
    }
}
