<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction;
use Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetCustomFieldAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetKeyAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetCustomTypeAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetSourcesAction;
use Commercetools\Core\Request\Categories\Command\CategorySetKeyAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetTagsAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeAssetOrderAction;
use Commercetools\Core\Request\Categories\Command\CategoryAddAssetAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeAssetNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryRemoveAssetAction;

class CategoriesActionBuilder
{
    /**
     * @return CategorySetExternalIdAction
     */
    public function setExternalId()
    {
        return CategorySetExternalIdAction::of();
    }

    /**
     * @return CategorySetDescriptionAction
     */
    public function setDescription()
    {
        return CategorySetDescriptionAction::of();
    }

    /**
     * @return CategorySetMetaTitleAction
     */
    public function setMetaTitle()
    {
        return CategorySetMetaTitleAction::of();
    }

    /**
     * @return CategorySetAssetCustomFieldAction
     */
    public function setAssetCustomField()
    {
        return CategorySetAssetCustomFieldAction::of();
    }

    /**
     * @return CategorySetAssetKeyAction
     */
    public function setAssetKey()
    {
        return CategorySetAssetKeyAction::of();
    }

    /**
     * @return CategorySetAssetCustomTypeAction
     */
    public function setAssetCustomType()
    {
        return CategorySetAssetCustomTypeAction::of();
    }

    /**
     * @return CategorySetMetaKeywordsAction
     */
    public function setMetaKeywords()
    {
        return CategorySetMetaKeywordsAction::of();
    }

    /**
     * @return CategorySetMetaDescriptionAction
     */
    public function setMetaDescription()
    {
        return CategorySetMetaDescriptionAction::of();
    }

    /**
     * @return CategoryChangeSlugAction
     */
    public function changeSlug()
    {
        return CategoryChangeSlugAction::of();
    }

    /**
     * @return CategorySetAssetDescriptionAction
     */
    public function setAssetDescription()
    {
        return CategorySetAssetDescriptionAction::of();
    }

    /**
     * @return CategoryChangeNameAction
     */
    public function changeName()
    {
        return CategoryChangeNameAction::of();
    }

    /**
     * @return CategorySetAssetSourcesAction
     */
    public function setAssetSources()
    {
        return CategorySetAssetSourcesAction::of();
    }

    /**
     * @return CategorySetKeyAction
     */
    public function setKey()
    {
        return CategorySetKeyAction::of();
    }

    /**
     * @return CategorySetAssetTagsAction
     */
    public function setAssetTags()
    {
        return CategorySetAssetTagsAction::of();
    }

    /**
     * @return CategoryChangeAssetOrderAction
     */
    public function changeAssetOrder()
    {
        return CategoryChangeAssetOrderAction::of();
    }

    /**
     * @return CategoryAddAssetAction
     */
    public function addAsset()
    {
        return CategoryAddAssetAction::of();
    }

    /**
     * @return CategoryChangeParentAction
     */
    public function changeParent()
    {
        return CategoryChangeParentAction::of();
    }

    /**
     * @return CategoryChangeOrderHintAction
     */
    public function changeOrderHint()
    {
        return CategoryChangeOrderHintAction::of();
    }

    /**
     * @return CategoryChangeAssetNameAction
     */
    public function changeAssetName()
    {
        return CategoryChangeAssetNameAction::of();
    }

    /**
     * @return CategoryRemoveAssetAction
     */
    public function removeAsset()
    {
        return CategoryRemoveAssetAction::of();
    }
}
