<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ProductCatalogData
 * @package Sphere\Core\Model\Product
 * @method bool getPublished()
 * @method ProductCatalogData setPublished(bool $published = null)
 * @method ProductData getCurrent()
 * @method ProductCatalogData setCurrent(ProductData $current = null)
 * @method ProductData getStaged()
 * @method ProductCatalogData setStaged(ProductData $staged = null)
 */
class ProductCatalogData extends JsonObject
{
    public function getFields()
    {
        return [
            'published' => [static::TYPE => 'bool'],
            'current' => [static::TYPE => '\Sphere\Core\Model\Product\ProductData'],
            'staged' => [static::TYPE => '\Sphere\Core\Model\Product\ProductData']
        ];
    }
}
