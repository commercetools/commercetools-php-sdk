<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class ShippingMethodReference
 * @package Sphere\Core\Model\ShippingMethod
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ShippingMethodReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ShippingMethodReference setId(string $id = null)
 * @method ShippingMethod getObj()
 * @method ShippingMethodReference setObj(ShippingMethod $obj = null)
 */
class ShippingMethodReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_SHIPPING_METHOD = 'shipping-method';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingMethod']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_SHIPPING_METHOD, $id, $context);
    }
}
