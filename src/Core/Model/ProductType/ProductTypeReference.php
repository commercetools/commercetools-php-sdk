<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:37
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-types.html#reference-types
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#producttype
 * @method string getTypeId()
 * @method ProductTypeReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductTypeReference setId(string $id = null)
 * @method ProductType getObj()
 * @method ProductTypeReference setObj(ProductType $obj = null)
 * @method string getKey()
 * @method ProductTypeReference setKey(string $key = null)
 */
class ProductTypeReference extends Reference
{
    const TYPE_PRODUCT_TYPE = 'product-type';
    const TYPE_CLASS = ProductType::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductTypeReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT_TYPE, $id, $context);
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return ProductTypeReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_PRODUCT_TYPE, $key, $context);
    }
}
