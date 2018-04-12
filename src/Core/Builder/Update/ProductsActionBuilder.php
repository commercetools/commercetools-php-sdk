<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Products\Command\ProductAddAssetAction;
use Commercetools\Core\Request\Products\Command\ProductAddExternalImageAction;
use Commercetools\Core\Request\Products\Command\ProductAddPriceAction;
use Commercetools\Core\Request\Products\Command\ProductAddToCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductAddVariantAction;
use Commercetools\Core\Request\Products\Command\ProductChangeAssetNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangeAssetOrderAction;
use Commercetools\Core\Request\Products\Command\ProductChangeMasterVariantAction;
use Commercetools\Core\Request\Products\Command\ProductChangeNameAction;
use Commercetools\Core\Request\Products\Command\ProductChangePriceAction;
use Commercetools\Core\Request\Products\Command\ProductChangeSlugAction;
use Commercetools\Core\Request\Products\Command\ProductMoveImageToPositionAction;
use Commercetools\Core\Request\Products\Command\ProductPublishAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveAssetAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveImageAction;
use Commercetools\Core\Request\Products\Command\ProductRemovePriceAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveVariantAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Commercetools\Core\Request\Products\Command\ProductRevertStagedVariantChangesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetSourcesAction;
use Commercetools\Core\Request\Products\Command\ProductSetAssetTagsAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeAction;
use Commercetools\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Commercetools\Core\Request\Products\Command\ProductSetCategoryOrderHintAction;
use Commercetools\Core\Request\Products\Command\ProductSetDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetDiscountedPriceAction;
use Commercetools\Core\Request\Products\Command\ProductSetKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaDescriptionAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetMetaTitleAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomFieldAction;
use Commercetools\Core\Request\Products\Command\ProductSetPriceCustomTypeAction;
use Commercetools\Core\Request\Products\Command\ProductSetPricesAction;
use Commercetools\Core\Request\Products\Command\ProductSetProductVariantKeyAction;
use Commercetools\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Commercetools\Core\Request\Products\Command\ProductSetSkuAction;
use Commercetools\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Commercetools\Core\Request\Products\Command\ProductTransitionStateAction;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;

class ProductsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
     * @param array $data
     * @return ProductAddAssetAction
     */
    public function addAsset(array $data = [])
    {
        return ProductAddAssetAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-external-image
     * @param array $data
     * @return ProductAddExternalImageAction
     */
    public function addExternalImage(array $data = [])
    {
        return ProductAddExternalImageAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-price
     * @param array $data
     * @return ProductAddPriceAction
     */
    public function addPrice(array $data = [])
    {
        return ProductAddPriceAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-to-category
     * @param array $data
     * @return ProductAddToCategoryAction
     */
    public function addToCategory(array $data = [])
    {
        return ProductAddToCategoryAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-productvariant
     * @param array $data
     * @return ProductAddVariantAction
     */
    public function addVariant(array $data = [])
    {
        return ProductAddVariantAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
     * @param array $data
     * @return ProductChangeAssetNameAction
     */
    public function changeAssetName(array $data = [])
    {
        return ProductChangeAssetNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-order
     * @param array $data
     * @return ProductChangeAssetOrderAction
     */
    public function changeAssetOrder(array $data = [])
    {
        return ProductChangeAssetOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-master-variant
     * @param array $data
     * @return ProductChangeMasterVariantAction
     */
    public function changeMasterVariant(array $data = [])
    {
        return ProductChangeMasterVariantAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-name
     * @param array $data
     * @return ProductChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ProductChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-price
     * @param array $data
     * @return ProductChangePriceAction
     */
    public function changePrice(array $data = [])
    {
        return ProductChangePriceAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-slug
     * @param array $data
     * @return ProductChangeSlugAction
     */
    public function changeSlug(array $data = [])
    {
        return ProductChangeSlugAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#move-image-to-position
     * @param array $data
     * @return ProductMoveImageToPositionAction
     */
    public function moveImageToPosition(array $data = [])
    {
        return ProductMoveImageToPositionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#publish
     * @param array $data
     * @return ProductPublishAction
     */
    public function publish(array $data = [])
    {
        return ProductPublishAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
     * @param array $data
     * @return ProductRemoveAssetAction
     */
    public function removeAsset(array $data = [])
    {
        return ProductRemoveAssetAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-from-category
     * @param array $data
     * @return ProductRemoveFromCategoryAction
     */
    public function removeFromCategory(array $data = [])
    {
        return ProductRemoveFromCategoryAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-image
     * @param array $data
     * @return ProductRemoveImageAction
     */
    public function removeImage(array $data = [])
    {
        return ProductRemoveImageAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-price
     * @param array $data
     * @return ProductRemovePriceAction
     */
    public function removePrice(array $data = [])
    {
        return ProductRemovePriceAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-productvariant
     * @param array $data
     * @return ProductRemoveVariantAction
     */
    public function removeVariant(array $data = [])
    {
        return ProductRemoveVariantAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-changes
     * @param array $data
     * @return ProductRevertStagedChangesAction
     */
    public function revertStagedChanges(array $data = [])
    {
        return ProductRevertStagedChangesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-variant-changes
     * @param array $data
     * @return ProductRevertStagedVariantChangesAction
     */
    public function revertStagedVariantChanges(array $data = [])
    {
        return ProductRevertStagedVariantChangesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
     * @param array $data
     * @return ProductSetAssetCustomFieldAction
     */
    public function setAssetCustomField(array $data = [])
    {
        return ProductSetAssetCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
     * @param array $data
     * @return ProductSetAssetCustomTypeAction
     */
    public function setAssetCustomType(array $data = [])
    {
        return ProductSetAssetCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
     * @param array $data
     * @return ProductSetAssetDescriptionAction
     */
    public function setAssetDescription(array $data = [])
    {
        return ProductSetAssetDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
     * @param array $data
     * @return ProductSetAssetKeyAction
     */
    public function setAssetKey(array $data = [])
    {
        return ProductSetAssetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return ProductSetAssetSourcesAction
     */
    public function setAssetSources(array $data = [])
    {
        return ProductSetAssetSourcesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return ProductSetAssetTagsAction
     */
    public function setAssetTags(array $data = [])
    {
        return ProductSetAssetTagsAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute
     * @param array $data
     * @return ProductSetAttributeAction
     */
    public function setAttribute(array $data = [])
    {
        return ProductSetAttributeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute-in-all-variants
     * @param array $data
     * @return ProductSetAttributeInAllVariantsAction
     */
    public function setAttributeInAllVariants(array $data = [])
    {
        return ProductSetAttributeInAllVariantsAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-category-order-hint
     * @param array $data
     * @return ProductSetCategoryOrderHintAction
     */
    public function setCategoryOrderHint(array $data = [])
    {
        return ProductSetCategoryOrderHintAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-description
     * @param array $data
     * @return ProductSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return ProductSetDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-discounted-price
     * @param array $data
     * @return ProductSetDiscountedPriceAction
     */
    public function setDiscountedPrice(array $data = [])
    {
        return ProductSetDiscountedPriceAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-key
     * @param array $data
     * @return ProductSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return ProductSetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-description
     * @param array $data
     * @return ProductSetMetaDescriptionAction
     */
    public function setMetaDescription(array $data = [])
    {
        return ProductSetMetaDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-keywords
     * @param array $data
     * @return ProductSetMetaKeywordsAction
     */
    public function setMetaKeywords(array $data = [])
    {
        return ProductSetMetaKeywordsAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-title
     * @param array $data
     * @return ProductSetMetaTitleAction
     */
    public function setMetaTitle(array $data = [])
    {
        return ProductSetMetaTitleAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-customfield
     * @param array $data
     * @return ProductSetPriceCustomFieldAction
     */
    public function setProductPriceCustomField(array $data = [])
    {
        return ProductSetPriceCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-custom-type
     * @param array $data
     * @return ProductSetPriceCustomTypeAction
     */
    public function setProductPriceCustomType(array $data = [])
    {
        return ProductSetPriceCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-prices
     * @param array $data
     * @return ProductSetPricesAction
     */
    public function setPrices(array $data = [])
    {
        return ProductSetPricesAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-productvariant-key
     * @param array $data
     * @return ProductSetProductVariantKeyAction
     */
    public function setProductVariantKey(array $data = [])
    {
        return ProductSetProductVariantKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-searchkeywords
     * @param array $data
     * @return ProductSetSearchKeywordsAction
     */
    public function setSearchKeywords(array $data = [])
    {
        return ProductSetSearchKeywordsAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-sku
     * @param array $data
     * @return ProductSetSkuAction
     */
    public function setSku(array $data = [])
    {
        return ProductSetSkuAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-taxcategory
     * @param array $data
     * @return ProductSetTaxCategoryAction
     */
    public function setTaxCategory(array $data = [])
    {
        return ProductSetTaxCategoryAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#transition-state
     * @param array $data
     * @return ProductTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return ProductTransitionStateAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#unpublish
     * @param array $data
     * @return ProductUnpublishAction
     */
    public function unpublish(array $data = [])
    {
        return ProductUnpublishAction::fromArray($data);
    }

    /**
     * @return ProductsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
