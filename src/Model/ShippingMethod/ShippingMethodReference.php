<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
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
    const TYPE_SHIPPING_METHOD = 'shipping-method';

    public function getFields()
    {
        $fields = parent::getFields();
        $fields[static::OBJ] = [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingMethod'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return ShippingMethodReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_SHIPPING_METHOD, $id, $context);
    }
}
