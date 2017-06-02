<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:35
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#productdraft
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
 * @method StateReference getState()
 * @method ProductDraft setState(StateReference $state = null)
 * @method bool getPublish()
 * @method ProductDraft setPublish(bool $publish = null)
 * @method string getKey()
 * @method ProductDraft setKey(string $key = null)
 */
class ProductDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [self::TYPE => LocalizedString::class],
            'slug' => [self::TYPE => LocalizedString::class],
            'description' => [self::TYPE => LocalizedString::class],
            'productType' => [self::TYPE => ProductTypeReference::class],
            'categories' => [self::TYPE => CategoryReferenceCollection::class],
            'masterVariant' => [self::TYPE => ProductVariantDraft::class],
            'variants' => [self::TYPE => ProductVariantDraftCollection::class],
            'metaTitle' => [self::TYPE => LocalizedString::class],
            'metaDescription' => [self::TYPE => LocalizedString::class],
            'metaKeywords' => [self::TYPE => LocalizedString::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'searchKeywords' => [static::TYPE => LocalizedSearchKeywords::class],
            'state' => [static::TYPE => StateReference::class],
            'publish' => [static::TYPE => 'bool'],
            'key' => [static::TYPE => 'string'],
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
