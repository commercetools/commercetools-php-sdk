<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
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
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
     * @param ProductSetAssetKeyAction|callable $action
     * @return $this
     */
    public function setAssetKey($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-keywords
     * @param ProductSetMetaKeywordsAction|callable $action
     * @return $this
     */
    public function setMetaKeywords($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetMetaKeywordsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param ProductSetAssetTagsAction|callable $action
     * @return $this
     */
    public function setAssetTags($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetTagsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-description
     * @param ProductSetMetaDescriptionAction|callable $action
     * @return $this
     */
    public function setMetaDescription($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetMetaDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
     * @param ProductSetAssetCustomTypeAction|callable $action
     * @return $this
     */
    public function setAssetCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-custom-type
     * @param ProductSetPriceCustomTypeAction|callable $action
     * @return $this
     */
    public function setProductPriceCustomType($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetPriceCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param ProductSetAssetSourcesAction|callable $action
     * @return $this
     */
    public function setAssetSources($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetSourcesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-image
     * @param ProductRemoveImageAction|callable $action
     * @return $this
     */
    public function removeImage($action = null)
    {
        $this->addAction($this->resolveAction(ProductRemoveImageAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#transition-state
     * @param ProductTransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(ProductTransitionStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute
     * @param ProductSetAttributeAction|callable $action
     * @return $this
     */
    public function setAttribute($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAttributeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-to-category
     * @param ProductAddToCategoryAction|callable $action
     * @return $this
     */
    public function addToCategory($action = null)
    {
        $this->addAction($this->resolveAction(ProductAddToCategoryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-changes
     * @param ProductRevertStagedChangesAction|callable $action
     * @return $this
     */
    public function revertStagedChanges($action = null)
    {
        $this->addAction($this->resolveAction(ProductRevertStagedChangesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-taxcategory
     * @param ProductSetTaxCategoryAction|callable $action
     * @return $this
     */
    public function setTaxCategory($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetTaxCategoryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#revert-staged-variant-changes
     * @param ProductRevertStagedVariantChangesAction|callable $action
     * @return $this
     */
    public function revertStagedVariantChanges($action = null)
    {
        $this->addAction($this->resolveAction(ProductRevertStagedVariantChangesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-customfield
     * @param ProductSetPriceCustomFieldAction|callable $action
     * @return $this
     */
    public function setProductPriceCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetPriceCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-order
     * @param ProductChangeAssetOrderAction|callable $action
     * @return $this
     */
    public function changeAssetOrder($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangeAssetOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#unpublish
     * @param ProductUnpublishAction|callable $action
     * @return $this
     */
    public function unpublish($action = null)
    {
        $this->addAction($this->resolveAction(ProductUnpublishAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-searchkeywords
     * @param ProductSetSearchKeywordsAction|callable $action
     * @return $this
     */
    public function setSearchKeywords($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetSearchKeywordsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-description
     * @param ProductSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-productvariant
     * @param ProductRemoveVariantAction|callable $action
     * @return $this
     */
    public function removeVariant($action = null)
    {
        $this->addAction($this->resolveAction(ProductRemoveVariantAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-title
     * @param ProductSetMetaTitleAction|callable $action
     * @return $this
     */
    public function setMetaTitle($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetMetaTitleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-sku
     * @param ProductSetSkuAction|callable $action
     * @return $this
     */
    public function setSku($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetSkuAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-prices
     * @param ProductSetPricesAction|callable $action
     * @return $this
     */
    public function setPrices($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetPricesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-productvariant-key
     * @param ProductSetProductVariantKeyAction|callable $action
     * @return $this
     */
    public function setProductVariantKey($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetProductVariantKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
     * @param ProductRemoveAssetAction|callable $action
     * @return $this
     */
    public function removeAsset($action = null)
    {
        $this->addAction($this->resolveAction(ProductRemoveAssetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
     * @param ProductChangeAssetNameAction|callable $action
     * @return $this
     */
    public function changeAssetName($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangeAssetNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-attribute-in-all-variants
     * @param ProductSetAttributeInAllVariantsAction|callable $action
     * @return $this
     */
    public function setAttributeInAllVariants($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAttributeInAllVariantsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-price
     * @param ProductAddPriceAction|callable $action
     * @return $this
     */
    public function addPrice($action = null)
    {
        $this->addAction($this->resolveAction(ProductAddPriceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-from-category
     * @param ProductRemoveFromCategoryAction|callable $action
     * @return $this
     */
    public function removeFromCategory($action = null)
    {
        $this->addAction($this->resolveAction(ProductRemoveFromCategoryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
     * @param ProductSetAssetCustomFieldAction|callable $action
     * @return $this
     */
    public function setAssetCustomField($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-external-image
     * @param ProductAddExternalImageAction|callable $action
     * @return $this
     */
    public function addExternalImage($action = null)
    {
        $this->addAction($this->resolveAction(ProductAddExternalImageAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-master-variant
     * @param ProductChangeMasterVariantAction|callable $action
     * @return $this
     */
    public function changeMasterVariant($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangeMasterVariantAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-discounted-price
     * @param ProductSetDiscountedPriceAction|callable $action
     * @return $this
     */
    public function setDiscountedPrice($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetDiscountedPriceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-key
     * @param ProductSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#move-image-to-position
     * @param ProductMoveImageToPositionAction|callable $action
     * @return $this
     */
    public function moveImageToPosition($action = null)
    {
        $this->addAction($this->resolveAction(ProductMoveImageToPositionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#publish
     * @param ProductPublishAction|callable $action
     * @return $this
     */
    public function publish($action = null)
    {
        $this->addAction($this->resolveAction(ProductPublishAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-productvariant
     * @param ProductAddVariantAction|callable $action
     * @return $this
     */
    public function addVariant($action = null)
    {
        $this->addAction($this->resolveAction(ProductAddVariantAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
     * @param ProductSetAssetDescriptionAction|callable $action
     * @return $this
     */
    public function setAssetDescription($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetAssetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-price
     * @param ProductRemovePriceAction|callable $action
     * @return $this
     */
    public function removePrice($action = null)
    {
        $this->addAction($this->resolveAction(ProductRemovePriceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-slug
     * @param ProductChangeSlugAction|callable $action
     * @return $this
     */
    public function changeSlug($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangeSlugAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
     * @param ProductAddAssetAction|callable $action
     * @return $this
     */
    public function addAsset($action = null)
    {
        $this->addAction($this->resolveAction(ProductAddAssetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-category-order-hint
     * @param ProductSetCategoryOrderHintAction|callable $action
     * @return $this
     */
    public function setCategoryOrderHint($action = null)
    {
        $this->addAction($this->resolveAction(ProductSetCategoryOrderHintAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-name
     * @param ProductChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-price
     * @param ProductChangePriceAction|callable $action
     * @return $this
     */
    public function changePrice($action = null)
    {
        $this->addAction($this->resolveAction(ProductChangePriceAction::class, $action));
        return $this;
    }

    /**
     * @return ProductsActionBuilder
     */
    public function of()
    {
        return new self();
    }

    /**
     * @param $class
     * @param $action
     * @return AbstractAction
     * @throws InvalidArgumentException
     */
    private function resolveAction($class, $action = null)
    {
        if (is_null($action) || is_callable($action)) {
            $callback = $action;
            $emptyAction = $class::of();
            $action = $this->callback($emptyAction, $callback);
        }
        if ($action instanceof $class) {
            return $action;
        }
        throw new InvalidArgumentException(
            sprintf('Expected method to be called with or callable to return %s', $class)
        );
    }

    /**
     * @param $action
     * @param callable $callback
     * @return AbstractAction
     */
    private function callback($action, callable $callback = null)
    {
        if (!is_null($callback)) {
            $action = $callback($action);
        }
        return $action;
    }

    /**
     * @param AbstractAction $action
     * @return $this;
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }
}
