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
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-external-id
     * @param array $data
     * @return CategorySetExternalIdAction
     */
    public function setExternalId(array $data = [])
    {
        return new CategorySetExternalIdAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-description
     * @param array $data
     * @return CategorySetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new CategorySetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-title
     * @param array $data
     * @return CategorySetMetaTitleAction
     */
    public function setMetaTitle(array $data = [])
    {
        return new CategorySetMetaTitleAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
     * @param array $data
     * @return CategorySetAssetCustomFieldAction
     */
    public function setAssetCustomField(array $data = [])
    {
        return new CategorySetAssetCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
     * @param array $data
     * @return CategorySetAssetKeyAction
     */
    public function setAssetKey(array $data = [])
    {
        return new CategorySetAssetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
     * @param array $data
     * @return CategorySetAssetCustomTypeAction
     */
    public function setAssetCustomType(array $data = [])
    {
        return new CategorySetAssetCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-keywords
     * @param array $data
     * @return CategorySetMetaKeywordsAction
     */
    public function setMetaKeywords(array $data = [])
    {
        return new CategorySetMetaKeywordsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-description
     * @param array $data
     * @return CategorySetMetaDescriptionAction
     */
    public function setMetaDescription(array $data = [])
    {
        return new CategorySetMetaDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-slug
     * @param array $data
     * @return CategoryChangeSlugAction
     */
    public function changeSlug(array $data = [])
    {
        return new CategoryChangeSlugAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
     * @param array $data
     * @return CategorySetAssetDescriptionAction
     */
    public function setAssetDescription(array $data = [])
    {
        return new CategorySetAssetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-name
     * @param array $data
     * @return CategoryChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new CategoryChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return CategorySetAssetSourcesAction
     */
    public function setAssetSources(array $data = [])
    {
        return new CategorySetAssetSourcesAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-key
     * @param array $data
     * @return CategorySetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new CategorySetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param array $data
     * @return CategorySetAssetTagsAction
     */
    public function setAssetTags(array $data = [])
    {
        return new CategorySetAssetTagsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-asset-order
     * @param array $data
     * @return CategoryChangeAssetOrderAction
     */
    public function changeAssetOrder(array $data = [])
    {
        return new CategoryChangeAssetOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
     * @param array $data
     * @return CategoryAddAssetAction
     */
    public function addAsset(array $data = [])
    {
        return new CategoryAddAssetAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-parent
     * @param array $data
     * @return CategoryChangeParentAction
     */
    public function changeParent(array $data = [])
    {
        return new CategoryChangeParentAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-orderhint
     * @param array $data
     * @return CategoryChangeOrderHintAction
     */
    public function changeOrderHint(array $data = [])
    {
        return new CategoryChangeOrderHintAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
     * @param array $data
     * @return CategoryChangeAssetNameAction
     */
    public function changeAssetName(array $data = [])
    {
        return new CategoryChangeAssetNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
     * @param array $data
     * @return CategoryRemoveAssetAction
     */
    public function removeAsset(array $data = [])
    {
        return new CategoryRemoveAssetAction($data);
    }

    /**
     * @return CategoriesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
