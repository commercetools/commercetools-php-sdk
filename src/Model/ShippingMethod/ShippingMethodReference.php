<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;


use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

class ShippingMethodReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_SHIPPING_METHOD = 'shipping-method';

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
        parent::__construct(static::TYPE_SHIPPING_METHOD, $id);
    }
}
