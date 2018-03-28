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
     * @return ProductSetAssetKeyAction
     */
    public function setAssetKey()
    {
        return ProductSetAssetKeyAction::of();
    }

    /**
     * @return ProductSetMetaKeywordsAction
     */
    public function setMetaKeywords()
    {
        return ProductSetMetaKeywordsAction::of();
    }

    /**
     * @return ProductSetAssetTagsAction
     */
    public function setAssetTags()
    {
        return ProductSetAssetTagsAction::of();
    }

    /**
     * @return ProductSetMetaDescriptionAction
     */
    public function setMetaDescription()
    {
        return ProductSetMetaDescriptionAction::of();
    }

    /**
     * @return ProductSetAssetCustomTypeAction
     */
    public function setAssetCustomType()
    {
        return ProductSetAssetCustomTypeAction::of();
    }

    /**
     * @return ProductSetPriceCustomTypeAction
     */
    public function setProductPriceCustomType()
    {
        return ProductSetPriceCustomTypeAction::of();
    }

    /**
     * @return ProductSetAssetSourcesAction
     */
    public function setAssetSources()
    {
        return ProductSetAssetSourcesAction::of();
    }

    /**
     * @return ProductRemoveImageAction
     */
    public function removeImage()
    {
        return ProductRemoveImageAction::of();
    }

    /**
     * @return ProductTransitionStateAction
     */
    public function transitionState()
    {
        return ProductTransitionStateAction::of();
    }

    /**
     * @return ProductSetAttributeAction
     */
    public function setAttribute()
    {
        return ProductSetAttributeAction::of();
    }

    /**
     * @return ProductAddToCategoryAction
     */
    public function addToCategory()
    {
        return ProductAddToCategoryAction::of();
    }

    /**
     * @return ProductRevertStagedChangesAction
     */
    public function revertStagedChanges()
    {
        return ProductRevertStagedChangesAction::of();
    }

    /**
     * @return ProductSetTaxCategoryAction
     */
    public function setTaxCategory()
    {
        return ProductSetTaxCategoryAction::of();
    }

    /**
     * @return ProductRevertStagedVariantChangesAction
     */
    public function revertStagedVariantChanges()
    {
        return ProductRevertStagedVariantChangesAction::of();
    }

    /**
     * @return ProductSetPriceCustomFieldAction
     */
    public function setProductPriceCustomField()
    {
        return ProductSetPriceCustomFieldAction::of();
    }

    /**
     * @return ProductChangeAssetOrderAction
     */
    public function changeAssetOrder()
    {
        return ProductChangeAssetOrderAction::of();
    }

    /**
     * @return ProductUnpublishAction
     */
    public function unpublish()
    {
        return ProductUnpublishAction::of();
    }

    /**
     * @return ProductSetSearchKeywordsAction
     */
    public function setSearchKeywords()
    {
        return ProductSetSearchKeywordsAction::of();
    }

    /**
     * @return ProductSetDescriptionAction
     */
    public function setDescription()
    {
        return ProductSetDescriptionAction::of();
    }

    /**
     * @return ProductRemoveVariantAction
     */
    public function removeVariant()
    {
        return ProductRemoveVariantAction::of();
    }

    /**
     * @return ProductSetMetaTitleAction
     */
    public function setMetaTitle()
    {
        return ProductSetMetaTitleAction::of();
    }

    /**
     * @return ProductSetSkuAction
     */
    public function setSku()
    {
        return ProductSetSkuAction::of();
    }

    /**
     * @return ProductSetPricesAction
     */
    public function setPrices()
    {
        return ProductSetPricesAction::of();
    }

    /**
     * @return ProductSetProductVariantKeyAction
     */
    public function setProductVariantKey()
    {
        return ProductSetProductVariantKeyAction::of();
    }

    /**
     * @return ProductRemoveAssetAction
     */
    public function removeAsset()
    {
        return ProductRemoveAssetAction::of();
    }

    /**
     * @return ProductChangeAssetNameAction
     */
    public function changeAssetName()
    {
        return ProductChangeAssetNameAction::of();
    }

    /**
     * @return ProductSetAttributeInAllVariantsAction
     */
    public function setAttributeInAllVariants()
    {
        return ProductSetAttributeInAllVariantsAction::of();
    }

    /**
     * @return ProductAddPriceAction
     */
    public function addPrice()
    {
        return ProductAddPriceAction::of();
    }

    /**
     * @return ProductRemoveFromCategoryAction
     */
    public function removeFromCategory()
    {
        return ProductRemoveFromCategoryAction::of();
    }

    /**
     * @return ProductSetAssetCustomFieldAction
     */
    public function setAssetCustomField()
    {
        return ProductSetAssetCustomFieldAction::of();
    }

    /**
     * @return ProductAddExternalImageAction
     */
    public function addExternalImage()
    {
        return ProductAddExternalImageAction::of();
    }

    /**
     * @return ProductChangeMasterVariantAction
     */
    public function changeMasterVariant()
    {
        return ProductChangeMasterVariantAction::of();
    }

    /**
     * @return ProductSetDiscountedPriceAction
     */
    public function setDiscountedPrice()
    {
        return ProductSetDiscountedPriceAction::of();
    }

    /**
     * @return ProductSetKeyAction
     */
    public function setKey()
    {
        return ProductSetKeyAction::of();
    }

    /**
     * @return ProductMoveImageToPositionAction
     */
    public function moveImageToPosition()
    {
        return ProductMoveImageToPositionAction::of();
    }

    /**
     * @return ProductPublishAction
     */
    public function publish()
    {
        return ProductPublishAction::of();
    }

    /**
     * @return ProductAddVariantAction
     */
    public function addVariant()
    {
        return ProductAddVariantAction::of();
    }

    /**
     * @return ProductSetAssetDescriptionAction
     */
    public function setAssetDescription()
    {
        return ProductSetAssetDescriptionAction::of();
    }

    /**
     * @return ProductRemovePriceAction
     */
    public function removePrice()
    {
        return ProductRemovePriceAction::of();
    }

    /**
     * @return ProductChangeSlugAction
     */
    public function changeSlug()
    {
        return ProductChangeSlugAction::of();
    }

    /**
     * @return ProductAddAssetAction
     */
    public function addAsset()
    {
        return ProductAddAssetAction::of();
    }

    /**
     * @return ProductSetCategoryOrderHintAction
     */
    public function setCategoryOrderHint()
    {
        return ProductSetCategoryOrderHintAction::of();
    }

    /**
     * @return ProductChangeNameAction
     */
    public function changeName()
    {
        return ProductChangeNameAction::of();
    }

    /**
     * @return ProductChangePriceAction
     */
    public function changePrice()
    {
        return ProductChangePriceAction::of();
    }
}
