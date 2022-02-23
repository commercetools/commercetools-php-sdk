<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#productdata
 * @method LocalizedString getName()
 * @method ProductData setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductData setDescription(LocalizedString $description = null)
 * @method LocalizedString getSlug()
 * @method ProductData setSlug(LocalizedString $slug = null)
 * @method CategoryReferenceCollection getCategories()
 * @method ProductData setCategories(CategoryReferenceCollection $categories = null)
 * @method array getCategoryOrderHints()
 * @method ProductData setCategoryOrderHints(array $categoryOrderHints = null)
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
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'slug' => [static::TYPE => LocalizedString::class],
            'categories' => [static::TYPE => CategoryReferenceCollection::class],
            'categoryOrderHints' => [static::TYPE => 'array', static::OPTIONAL => true],
            'metaTitle' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'metaDescription' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'metaKeywords' => [static::TYPE => LocalizedString::class, static::OPTIONAL => true],
            'masterVariant' => [static::TYPE => ProductVariant::class],
            'variants' => [static::TYPE => ProductVariantCollection::class],
            'searchKeywords' => [static::TYPE => LocalizedSearchKeywords::class],
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
}
