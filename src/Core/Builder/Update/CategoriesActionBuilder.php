<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Categories\Command\CategoryAddAssetAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeAssetNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeAssetOrderAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeOrderHintAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeParentAction;
use Commercetools\Core\Request\Categories\Command\CategoryChangeSlugAction;
use Commercetools\Core\Request\Categories\Command\CategoryRemoveAssetAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetCustomFieldAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetCustomTypeAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetKeyAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetSourcesAction;
use Commercetools\Core\Request\Categories\Command\CategorySetAssetTagsAction;
use Commercetools\Core\Request\Categories\Command\CategorySetDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetExternalIdAction;
use Commercetools\Core\Request\Categories\Command\CategorySetKeyAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaDescriptionAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaKeywordsAction;
use Commercetools\Core\Request\Categories\Command\CategorySetMetaTitleAction;

class CategoriesActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
     * @param CategoryAddAssetAction|callable $action
     * @return $this
     */
    public function addAsset($action = null)
    {
        $this->addAction($this->resolveAction(CategoryAddAssetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
     * @param CategoryChangeAssetNameAction|callable $action
     * @return $this
     */
    public function changeAssetName($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeAssetNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-asset-order
     * @param CategoryChangeAssetOrderAction|callable $action
     * @return $this
     */
    public function changeAssetOrder($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeAssetOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-name
     * @param CategoryChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-orderhint
     * @param CategoryChangeOrderHintAction|callable $action
     * @return $this
     */
    public function changeOrderHint($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeOrderHintAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-parent
     * @param CategoryChangeParentAction|callable $action
     * @return $this
     */
    public function changeParent($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeParentAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#change-slug
     * @param CategoryChangeSlugAction|callable $action
     * @return $this
     */
    public function changeSlug($action = null)
    {
        $this->addAction($this->resolveAction(CategoryChangeSlugAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
     * @param CategoryRemoveAssetAction|callable $action
     * @return $this
     */
    public function removeAsset($action = null)
    {
        $this->addAction($this->resolveAction(CategoryRemoveAssetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
     * @param CategorySetAssetCustomFieldAction|callable $action
     * @return $this
     */
    public function setAssetCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
     * @param CategorySetAssetCustomTypeAction|callable $action
     * @return $this
     */
    public function setAssetCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
     * @param CategorySetAssetDescriptionAction|callable $action
     * @return $this
     */
    public function setAssetDescription($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
     * @param CategorySetAssetKeyAction|callable $action
     * @return $this
     */
    public function setAssetKey($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param CategorySetAssetSourcesAction|callable $action
     * @return $this
     */
    public function setAssetSources($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetSourcesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
     * @param CategorySetAssetTagsAction|callable $action
     * @return $this
     */
    public function setAssetTags($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetAssetTagsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-description
     * @param CategorySetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-external-id
     * @param CategorySetExternalIdAction|callable $action
     * @return $this
     */
    public function setExternalId($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetExternalIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-key
     * @param CategorySetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-description
     * @param CategorySetMetaDescriptionAction|callable $action
     * @return $this
     */
    public function setMetaDescription($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetMetaDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-keywords
     * @param CategorySetMetaKeywordsAction|callable $action
     * @return $this
     */
    public function setMetaKeywords($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetMetaKeywordsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-title
     * @param CategorySetMetaTitleAction|callable $action
     * @return $this
     */
    public function setMetaTitle($action = null)
    {
        $this->addAction($this->resolveAction(CategorySetMetaTitleAction::class, $action));
        return $this;
    }

    /**
     * @return CategoriesActionBuilder
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
