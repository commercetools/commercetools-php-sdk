<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-projection
 * @method string getId()
 * @method ProductProjection setId(string $id = null)
 * @method int getVersion()
 * @method ProductProjection setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductProjection setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
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
 * @method ReviewRatingStatistics getReviewRatingStatistics()
 * @method ProductProjection setReviewRatingStatistics(ReviewRatingStatistics $reviewRatingStatistics = null)
 * @method StateReference getState()
 * @method ProductProjection setState(StateReference $state = null)
 * @method string getCategoryOrderHints()
 * @method ProductProjection setCategoryOrderHints(string $categoryOrderHints = null)
 */
class ProductProjection extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'productType' => [static::TYPE => '\Commercetools\Core\Model\ProductType\ProductTypeReference'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'categories' => [static::TYPE => '\Commercetools\Core\Model\Category\CategoryReferenceCollection'],
            'categoryOrderHints' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'hasStagedChanges' => [static::TYPE => 'bool'],
            'published' => [static::TYPE => 'bool'],
            'masterVariant' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariant'],
            'variants' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariantCollection'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'searchKeywords' => [static::TYPE => '\Commercetools\Core\Model\Product\LocalizedSearchKeywords'],
            'reviewRatingStatistics' => [static::TYPE => '\Commercetools\Core\Model\Review\ReviewRatingStatistics'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }

    /**
     * @param $variantId
     * @return ProductVariant|null
     */
    public function getVariantById($variantId)
    {
        if ($variantId == $this->getMasterVariant()->getId()) {
            return $this->getMasterVariant();
        }

        return $this->getVariants()->getById($variantId);
    }

    /**
     * @param $sku
     * @return ProductVariant
     */
    public function getVariantBySku($sku)
    {
        if ($sku == $this->getMasterVariant()->getSku()) {
            return $this->getMasterVariant();
        }

        return $this->getVariants()->getBySku($sku);
    }

    public function getAllVariants()
    {
        $variants = $this->getRaw('variants', []);
        array_unshift($variants, $this->getRaw('masterVariant'));
        return ProductVariantCollection::fromArray($variants, $this->getContextCallback());
    }
}
