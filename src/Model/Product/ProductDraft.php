<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Commercetools\Core\Model\Product
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
 * @method ProductVariantDraftCollection getVariants()
 * @method ProductDraft setVariants(ProductVariantDraftCollection $variants = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductDraft setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaDescription()
 * @method ProductDraft setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductDraft setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductDraft setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method LocalizedSearchKeywords getSearchKeywords()
 * @method ProductDraft setSearchKeywords(LocalizedSearchKeywords $searchKeywords = null)
 */
class ProductDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'productType' => [self::TYPE => '\Commercetools\Core\Model\ProductType\ProductTypeReference'],
            'categories' => [self::TYPE => '\Commercetools\Core\Model\Category\CategoryReferenceCollection'],
            'masterVariant' => [self::TYPE => '\Commercetools\Core\Model\Product\ProductVariantDraft'],
            'variants' => [self::TYPE => '\Commercetools\Core\Model\Product\ProductVariantDraftCollection'],
            'metaTitle' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaDescription' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [self::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'searchKeywords' => [static::TYPE => '\Commercetools\Core\Model\Product\LocalizedSearchKeywords']
        ];
    }

    /**
     * @param ProductTypeReference $productType
     * @param LocalizedString $name
     * @param LocalizedString $slug
     * @param Context|callable $context
     * @return ProductDraft
     */
    public static function ofTypeNameAndSlug(
        ProductTypeReference $productType,
        LocalizedString $name,
        LocalizedString $slug,
        $context = null
    ) {
        $draft = static::of($context);
        return $draft->setProductType($productType)
            ->setName($name)
            ->setSlug($slug);
    }
}
