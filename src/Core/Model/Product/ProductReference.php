<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Product
 * @ramlTestIgnoreFields('key')
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-products.html#product
 * @method string getTypeId()
 * @method ProductReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ProductReference setId(string $id = null)
 * @method Product getObj()
 * @method ProductReference setObj(Product $obj = null)
 * @method string getKey()
 * @method ProductReference setKey(string $key = null)
 */
class ProductReference extends Reference
{
    const TYPE_PRODUCT = 'product';
    const TYPE_CLASS = Product::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return ProductReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PRODUCT, $id, $context);
    }
}
