<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class DiscountCodeReference
 * @package Sphere\Core\Model\DiscountCode
 * @method string getTypeId()
 * @method DiscountCodeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method DiscountCodeReference setId(string $id = null)
 * @method DiscountCode getObj()
 * @method DiscountCodeReference setObj(DiscountCode $obj = null)
 */
class DiscountCodeReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_DISCOUNT_CODE = 'discount-code';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\DiscountCode\DiscountCode']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_DISCOUNT_CODE, $id, $context);
    }
}
