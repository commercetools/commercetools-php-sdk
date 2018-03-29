<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Products\Command\ProductSetAssetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetTagsAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetSourcesAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveImageAction;
use Commercetools\Core\Request\Products\Command\ProductTransitionStateAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeAction;
use Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedVariantChangesAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductChangeAssetOrderAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuAction;
use Commercetools\Core\Request\Products\Command\ProductSetPricesAction;
use Commercetools\Core\Request\Products\Command\ProductSetProductVariantKeyAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveAssetAction;
use Commercetools\Core\Request\Products\Command\ProductChangeAssetNameAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction;
use Commercetools\Core\Request\Products\Command\ProductChangeMasterVariantAction;
use Commercetools\Core\Request\Products\Command\ProductSetDiscountedPriceAction;
use Commercetools\Core\Request\Products\Command\ProductSetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductMoveImageToPositionAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductRemovePriceAction;
use Commercetools\Core\Request\Products\Command\ProductChangeSlugAction;
use Commercetools\Core\Request\Products\Command\ProductAddAssetAction;
use Commercetools\Core\Request\Products\Command\ProductSetCategoryOrderHintAction;
use Commercetools\Core\Request\Products\Command\ProductChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;

class ProductsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
     * @param array $data
     * @return ProductSetAssetKeyAction
     */
    public function setAssetKey(array $data = [])
    {
        return new ProductSetAssetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-keywords
     * @param array $data
     * @return ProductSetMetaKeywordsAction
     */
    public function setMetaKeywords(array $data = [])
    {
        return new ProductSetMetaKeywordsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return ProductSetAssetTagsAction
     */
    public function setAssetTags(array $data = [])
    {
        return new ProductSetAssetTagsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-description
     * @param array $data
     * @return ProductSetMetaDescriptionAction
     */
    public function setMetaDescription(array $data = [])
    {
        return new ProductSetMetaDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
     * @param array $data
     * @return ProductSetAssetCustomTypeAction
     */
    public function setAssetCustomType(array $data = [])
    {
        return new ProductSetAssetCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-custom-type
     * @param array $data
     * @return ProductSetPriceCustomTypeAction
     */
    public function setProductPriceCustomType(array $data = [])
    {
        return new ProductSetPriceCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return ProductSetAssetSourcesAction
     */
    public function setAssetSources(array $data = [])
    {
        return new ProductSetAssetSourcesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-image
     * @param array $data
     * @return ProductRemoveImageAction
     */
    public function removeImage(array $data = [])
    {
        return new ProductRemoveImageAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#transition-state
     * @param array $data
     * @return ProductTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return new ProductTransitionStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute
     * @param array $data
     * @return ProductSetAttributeAction
     */
    public function setAttribute(array $data = [])
    {
        return new ProductSetAttributeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-to-category
     * @param array $data
     * @return ProductAddToCategoryAction
     */
    public function addToCategory(array $data = [])
    {
        return new ProductAddToCategoryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-changes
     * @param array $data
     * @return ProductRevertStagedChangesAction
     */
    public function revertStagedChanges(array $data = [])
    {
        return new ProductRevertStagedChangesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-taxcategory
     * @param array $data
     * @return ProductSetTaxCategoryAction
     */
    public function setTaxCategory(array $data = [])
    {
        return new ProductSetTaxCategoryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-variant-changes
     * @param array $data
     * @return ProductRevertStagedVariantChangesAction
     */
    public function revertStagedVariantChanges(array $data = [])
    {
        return new ProductRevertStagedVariantChangesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-customfield
     * @param array $data
     * @return ProductSetPriceCustomFieldAction
     */
    public function setProductPriceCustomField(array $data = [])
    {
        return new ProductSetPriceCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-order
     * @param array $data
     * @return ProductChangeAssetOrderAction
     */
    public function changeAssetOrder(array $data = [])
    {
        return new ProductChangeAssetOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#unpublish
     * @param array $data
     * @return ProductUnpublishAction
     */
    public function unpublish(array $data = [])
    {
        return new ProductUnpublishAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-searchkeywords
     * @param array $data
     * @return ProductSetSearchKeywordsAction
     */
    public function setSearchKeywords(array $data = [])
    {
        return new ProductSetSearchKeywordsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-description
     * @param array $data
     * @return ProductSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new ProductSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-productvariant
     * @param array $data
     * @return ProductRemoveVariantAction
     */
    public function removeVariant(array $data = [])
    {
        return new ProductRemoveVariantAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-title
     * @param array $data
     * @return ProductSetMetaTitleAction
     */
    public function setMetaTitle(array $data = [])
    {
        return new ProductSetMetaTitleAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-sku
     * @param array $data
     * @return ProductSetSkuAction
     */
    public function setSku(array $data = [])
    {
        return new ProductSetSkuAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-prices
     * @param array $data
     * @return ProductSetPricesAction
     */
    public function setPrices(array $data = [])
    {
        return new ProductSetPricesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-productvariant-key
     * @param array $data
     * @return ProductSetProductVariantKeyAction
     */
    public function setProductVariantKey(array $data = [])
    {
        return new ProductSetProductVariantKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
     * @param array $data
     * @return ProductRemoveAssetAction
     */
    public function removeAsset(array $data = [])
    {
        return new ProductRemoveAssetAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
     * @param array $data
     * @return ProductChangeAssetNameAction
     */
    public function changeAssetName(array $data = [])
    {
        return new ProductChangeAssetNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute-in-all-variants
     * @param array $data
     * @return ProductSetAttributeInAllVariantsAction
     */
    public function setAttributeInAllVariants(array $data = [])
    {
        return new ProductSetAttributeInAllVariantsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-price
     * @param array $data
     * @return ProductAddPriceAction
     */
    public function addPrice(array $data = [])
    {
        return new ProductAddPriceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-from-category
     * @param array $data
     * @return ProductRemoveFromCategoryAction
     */
    public function removeFromCategory(array $data = [])
    {
        return new ProductRemoveFromCategoryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
     * @param array $data
     * @return ProductSetAssetCustomFieldAction
     */
    public function setAssetCustomField(array $data = [])
    {
        return new ProductSetAssetCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-external-image
     * @param array $data
     * @return ProductAddExternalImageAction
     */
    public function addExternalImage(array $data = [])
    {
        return new ProductAddExternalImageAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-master-variant
     * @param array $data
     * @return ProductChangeMasterVariantAction
     */
    public function changeMasterVariant(array $data = [])
    {
        return new ProductChangeMasterVariantAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-discounted-price
     * @param array $data
     * @return ProductSetDiscountedPriceAction
     */
    public function setDiscountedPrice(array $data = [])
    {
        return new ProductSetDiscountedPriceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-key
     * @param array $data
     * @return ProductSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new ProductSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#move-image-to-position
     * @param array $data
     * @return ProductMoveImageToPositionAction
     */
    public function moveImageToPosition(array $data = [])
    {
        return new ProductMoveImageToPositionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#publish
     * @param array $data
     * @return ProductPublishAction
     */
    public function publish(array $data = [])
    {
        return new ProductPublishAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-productvariant
     * @param array $data
     * @return ProductAddVariantAction
     */
    public function addVariant(array $data = [])
    {
        return new ProductAddVariantAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
     * @param array $data
     * @return ProductSetAssetDescriptionAction
     */
    public function setAssetDescription(array $data = [])
    {
        return new ProductSetAssetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-price
     * @param array $data
     * @return ProductRemovePriceAction
     */
    public function removePrice(array $data = [])
    {
        return new ProductRemovePriceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-slug
     * @param array $data
     * @return ProductChangeSlugAction
     */
    public function changeSlug(array $data = [])
    {
        return new ProductChangeSlugAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
     * @param array $data
     * @return ProductAddAssetAction
     */
    public function addAsset(array $data = [])
    {
        return new ProductAddAssetAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-category-order-hint
     * @param array $data
     * @return ProductSetCategoryOrderHintAction
     */
    public function setCategoryOrderHint(array $data = [])
    {
        return new ProductSetCategoryOrderHintAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-name
     * @param array $data
     * @return ProductChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ProductChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-price
     * @param array $data
     * @return ProductChangePriceAction
     */
    public function changePrice(array $data = [])
    {
        return new ProductChangePriceAction($data);
    }

    /**
     * @return ProductsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
