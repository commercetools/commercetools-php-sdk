<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReferenceCollection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products.html#product-data
 * @method LocalizedString getName()
 * @method ProductData setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductData setDescription(LocalizedString $description = null)
 * @method LocalizedString getSlug()
 * @method ProductData setSlug(LocalizedString $slug = null)
 * @method CategoryReferenceCollection getCategories()
 * @method ProductData setCategories(CategoryReferenceCollection $categories = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductData setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaDescription()
 * @method ProductData setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductData setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method ProductVariant getMasterVariant()
 * @method ProductData setMasterVariant(ProductVariant $masterVariant = null)
 * @method ProductVariantCollection getVariants()
 * @method ProductData setVariants(ProductVariantCollection $variants = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductData setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 */
class ProductData extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'categories' => [static::TYPE => '\Sphere\Core\Model\Category\CategoryReferenceCollection'],
            'metaTitle' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'masterVariant' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariant'],
            'variants' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariantCollection'],
            'searchKeywords' => [static::TYPE => '\Sphere\Core\Model\Product\LocalizedSearchKeywords']
        ];
    }
}
