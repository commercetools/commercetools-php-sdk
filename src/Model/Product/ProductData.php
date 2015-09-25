<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Category\CategoryReferenceCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-data
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
 * @method StateReference getState()
 * @method ProductData setState(StateReference $state = null)
 */
class ProductData extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'categories' => [static::TYPE => '\Commercetools\Core\Model\Category\CategoryReferenceCollection'],
            'metaTitle' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'masterVariant' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariant'],
            'variants' => [static::TYPE => '\Commercetools\Core\Model\Product\ProductVariantCollection'],
            'searchKeywords' => [static::TYPE => '\Commercetools\Core\Model\Product\LocalizedSearchKeywords'],
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
}
