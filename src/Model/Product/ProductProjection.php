<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\ReferenceObjectInterface;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-productProjections.html#productprojection
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
 * @method array getCategoryOrderHints()
 * @method ProductProjection setCategoryOrderHints(array $categoryOrderHints = null)
 * @method string getKey()
 * @method ProductProjection setKey(string $key = null)
 */
class ProductProjection extends JsonObject implements ReferenceObjectInterface
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ],
            'productType' => [static::TYPE => ProductTypeReference::class],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'slug' => [static::TYPE => LocalizedString::class],
            'categories' => [static::TYPE => CategoryReferenceCollection::class],
            'categoryOrderHints' => [static::TYPE => 'array'],
            'metaTitle' => [static::TYPE => LocalizedString::class],
            'metaDescription' => [static::TYPE => LocalizedString::class],
            'metaKeywords' => [static::TYPE => LocalizedString::class],
            'hasStagedChanges' => [static::TYPE => 'bool'],
            'published' => [static::TYPE => 'bool'],
            'masterVariant' => [static::TYPE => ProductVariant::class],
            'variants' => [static::TYPE => ProductVariantCollection::class],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
            'searchKeywords' => [static::TYPE => LocalizedSearchKeywords::class],
            'reviewRatingStatistics' => [static::TYPE => ReviewRatingStatistics::class],
            'state' => [static::TYPE => StateReference::class],
            'key' => [static::TYPE => 'string'],
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

    /**
     * @return ProductVariantCollection
     */
    public function getAllVariants()
    {
        $variants = $this->getRaw('variants', []);
        array_unshift($variants, $this->getRaw('masterVariant'));
        return ProductVariantCollection::fromArray($variants, $this->getContextCallback());
    }

    public function getReferenceIdentifier()
    {
        return $this->getId();
    }

    /**
     * @return ProductReference
     */
    public function getReference()
    {
        $reference = ProductReference::ofId($this->getReferenceIdentifier(), $this->getContextCallback());
        return $reference;
    }
}
