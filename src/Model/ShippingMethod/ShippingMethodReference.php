<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shipping-method
 * @method string getTypeId()
 * @method ShippingMethodReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ShippingMethodReference setId(string $id = null)
 * @method ShippingMethod getObj()
 * @method ShippingMethodReference setObj(ShippingMethod $obj = null)
 * @method string getKey()
 * @method ShippingMethodReference setKey(string $key = null)
 */
class ShippingMethodReference extends Reference
{
    const TYPE_SHIPPING_METHOD = 'shipping-method';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\ShippingMethod\ShippingMethod'];

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
