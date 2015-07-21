<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:37
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;

/**
 * @package Sphere\Core\Model\ProductType
 * @link http://dev.sphere.io/http-api-types.html#reference
 * @method string getTypeId()
 * @method ProductTypeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductTypeReference setId(string $id = null)
 * @method ProductType getObj()
 * @method ProductTypeReference setObj(ProductType $obj = null)
 */
class ProductTypeReference extends Reference
{
    const TYPE_PRODUCT_TYPE = 'product-type';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductType']
        ];
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductTypeReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT_TYPE, $id, $context);
    }
}
