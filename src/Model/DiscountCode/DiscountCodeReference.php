<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\DiscountCode;


use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

class DiscountCodeReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_DISCOUNT_CODE = 'discount-code';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => 'array']
        ];
    }

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_DISCOUNT_CODE, $id);
    }
}
