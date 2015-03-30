<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Category\CategoryReferenceCollection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\ProductType\ProductTypeReference;
use Sphere\Core\Model\TaxCategory\TaxCategory;

/**
 * Class ProductDraft
 * @package Sphere\Core\Model\Product
 * @method LocalizedString getName()
 * @method ProductDraft setName(LocalizedString $name = null)
 * @method LocalizedString getSlug()
 * @method ProductDraft setSlug(LocalizedString $slug = null)
 * @method LocalizedString getDescription()
 * @method ProductDraft setDescription(LocalizedString $description = null)
 * @method ProductTypeReference getProductType()
 * @method ProductDraft setProductType(ProductTypeReference $productType = null)
 * @method CategoryReferenceCollection getCategories()
 * @method ProductDraft setCategories(CategoryReferenceCollection $categories = null)
 * @method ProductVariantDraft getMasterVariant()
 * @method ProductDraft setMasterVariant(ProductVariantDraft $masterVariant = null)
 * @method ProductVariantCollection getVariants()
 * @method ProductDraft setVariants(ProductVariantCollection $variants = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductDraft setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaDescription()
 * @method ProductDraft setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductDraft setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method TaxCategory getTaxCategory()
 * @method ProductDraft setTaxCategory(TaxCategory $taxCategory = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductDraft setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 */
class ProductDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'name' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'productType' => [self::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference'],
            'categories' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReferenceCollection'],
            'masterVariant' => [self::TYPE => '\Sphere\Core\Model\Product\ProductVariantDraft'],
            'variants' => [self::TYPE => '\Sphere\Core\Model\Product\ProductVariantCollection'],
            'metaTitle' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaDescription' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory'],
            'searchKeywords' => [static::TYPE => '\Sphere\Core\Model\Product\LocalizedSearchKeywords']
        ];
    }

    public function __construct(
        ProductTypeReference $productType,
        LocalizedString $name,
        LocalizedString $slug,
        Context $context = null
    ) {
        $this->setContext($context);
        $this->setName($name);
        $this->setProductType($productType);
        $this->setSlug($slug);
    }

    /**
     * @param array $data
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        $draft = new static(
            ProductTypeReference::fromArray($data['reference'], $context),
            LocalizedString::fromArray($data['name'], $context),
            LocalizedString::fromArray($data['slug'], $context),
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
