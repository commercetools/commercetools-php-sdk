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
 * Class ProductProjection
 * @package Sphere\Core\Model\Product
 * @method LocalizedString getName()
 * @method ProductProjection setName(LocalizedString $name)
 * @method LocalizedString getDescription()
 * @method ProductProjection setDescription(LocalizedString $description)
 * @method ProductVariant getMasterVariant()
 * @method ProductProjection setMasterVariant(ProductVariant $masterVariant)
 * @method string getId()
 * @method ProductProjection setId(string $id)
 * @method int getVersion()
 * @method ProductProjection setVersion(int $version)
 * @method \DateTime getCreatedAt()
 * @method ProductProjection setCreatedAt(\DateTime $createdAt)
 * @method \DateTime getLastModifiedAt()
 * @method ProductProjection setLastModifiedAt(\DateTime $lastModifiedAt)
 * @method ProductTypeReference getProductType()
 * @method ProductProjection setProductType(ProductTypeReference $productType)
 * @method LocalizedString getSlug()
 * @method ProductProjection setSlug(LocalizedString $slug)
 * @method CategoryReferenceCollection getCategories()
 * @method ProductProjection setCategories(CategoryReferenceCollection $categories)
 * @method LocalizedString getMetaTitle()
 * @method ProductProjection setMetaTitle(LocalizedString $metaTitle)
 * @method LocalizedString getMetaDescription()
 * @method ProductProjection setMetaDescription(LocalizedString $metaDescription)
 * @method LocalizedString getMetaKeywords()
 * @method ProductProjection setMetaKeywords(LocalizedString $metaKeywords)
 * @method bool getHasStagedChanges()
 * @method ProductProjection setHasStagedChanges(bool $hasStagedChanges)
 * @method bool getPublished()
 * @method ProductProjection setPublished(bool $published)
 * @method ProductVariant getVariants()
 * @method ProductProjection setVariants(ProductVariant $variants)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductProjection setTaxCategory(TaxCategoryReference $taxCategory)
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
            'variants' => [static::TYPE => '\Sphere\Core\Model\Product\ProductVariant'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference']
        ];
    }
}
