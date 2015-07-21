<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReferenceCollection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\ProductType\ProductTypeReference;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products.html#product-projection
 * @method string getId()
 * @method ProductProjection setId(string $id = null)
 * @method int getVersion()
 * @method ProductProjection setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method ProductProjection setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method ProductProjection setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method ProductTypeReference getProductType()
 * @method ProductProjection setProductType(ProductTypeReference $productType = null)
 * @method LocalizedString getName()
 * @method ProductProjection setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductProjection setDescription(LocalizedString $description = null)
 * @method LocalizedString getSlug()
 * @method ProductProjection setSlug(LocalizedString $slug = null)
 * @method CategoryReferenceCollection getCategories()
 * @method ProductProjection setCategories(CategoryReferenceCollection $categories = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductProjection setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaDescription()
 * @method ProductProjection setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductProjection setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method bool getHasStagedChanges()
 * @method ProductProjection setHasStagedChanges(bool $hasStagedChanges = null)
 * @method bool getPublished()
 * @method ProductProjection setPublished(bool $published = null)
 * @method ProductVariant getMasterVariant()
 * @method ProductProjection setMasterVariant(ProductVariant $masterVariant = null)
 * @method ProductVariantCollection getVariants()
 * @method ProductProjection setVariants(ProductVariantCollection $variants = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductProjection setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductProjection setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 */
class ProductProjection extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'productType' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'categories' => [static::TYPE => '\Sphere\Core\Model\Category\CategoryReferenceCollection'],
            'metaTitle' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'hasStagedChanges' => [static::TYPE => 'bool'],
            'published' => [static::TYPE => 'bool'],
            'masterVariant' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariant'],
            'variants' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariantCollection'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
            'searchKeywords' => [static::TYPE => '\Sphere\Core\Model\Product\LocalizedSearchKeywords']
        ];
    }
}
