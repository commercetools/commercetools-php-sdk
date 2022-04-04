<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Stores\Command\StoreAddDistributionChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreAddProductSelectionAction;
use Commercetools\Core\Request\Stores\Command\StoreAddSupplyChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreChangeProductSelectionAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveDistributionChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveProductSelectionAction;
use Commercetools\Core\Request\Stores\Command\StoreRemoveSupplyChannelAction;
use Commercetools\Core\Request\Stores\Command\StoreSetDistributionChannelsAction;
use Commercetools\Core\Request\Stores\Command\StoreSetLanguagesAction;
use Commercetools\Core\Request\Stores\Command\StoreSetNameAction;
use Commercetools\Core\Request\Stores\Command\StoreSetProductSelectionsAction;
use Commercetools\Core\Request\Stores\Command\StoreSetSupplyChannelsAction;

class StoresActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/api/projects/stores#add-distribution-channel
     * @param StoreAddDistributionChannelAction|callable $action
     * @return $this
     */
    public function addDistributionChannel($action = null)
    {
        $this->addAction($this->resolveAction(StoreAddDistributionChannelAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StoreAddProductSelectionAction|callable $action
     * @return $this
     */
    public function addProductSelection($action = null)
    {
        $this->addAction($this->resolveAction(StoreAddProductSelectionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#add-supply-channel
     * @param StoreAddSupplyChannelAction|callable $action
     * @return $this
     */
    public function addSupplyChannel($action = null)
    {
        $this->addAction($this->resolveAction(StoreAddSupplyChannelAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StoreChangeProductSelectionAction|callable $action
     * @return $this
     */
    public function changeProductSelection($action = null)
    {
        $this->addAction($this->resolveAction(StoreChangeProductSelectionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#remove-distribution-channel
     * @param StoreRemoveDistributionChannelAction|callable $action
     * @return $this
     */
    public function removeDistributionChannel($action = null)
    {
        $this->addAction($this->resolveAction(StoreRemoveDistributionChannelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#remove-product-selection
     * @param StoreRemoveProductSelectionAction|callable $action
     * @return $this
     */
    public function removeProductSelection($action = null)
    {
        $this->addAction($this->resolveAction(StoreRemoveProductSelectionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#remove-supply-channel
     * @param StoreRemoveSupplyChannelAction|callable $action
     * @return $this
     */
    public function removeSupplyChannel($action = null)
    {
        $this->addAction($this->resolveAction(StoreRemoveSupplyChannelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#set-distribution-channels
     * @param StoreSetDistributionChannelsAction|callable $action
     * @return $this
     */
    public function setDistributionChannels($action = null)
    {
        $this->addAction($this->resolveAction(StoreSetDistributionChannelsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#set-languages
     * @param StoreSetLanguagesAction|callable $action
     * @return $this
     */
    public function setLanguages($action = null)
    {
        $this->addAction($this->resolveAction(StoreSetLanguagesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-stores#set-name
     * @param StoreSetNameAction|callable $action
     * @return $this
     */
    public function setName($action = null)
    {
        $this->addAction($this->resolveAction(StoreSetNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#set-product-selections
     * @param StoreSetProductSelectionsAction|callable $action
     * @return $this
     */
    public function setProductSelections($action = null)
    {
        $this->addAction($this->resolveAction(StoreSetProductSelectionsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/api/projects/stores#set-supply-channels
     * @param StoreSetSupplyChannelsAction|callable $action
     * @return $this
     */
    public function setSupplyChannels($action = null)
    {
        $this->addAction($this->resolveAction(StoreSetSupplyChannelsAction::class, $action));
        return $this;
    }

    /**
     * @return StoresActionBuilder
     */
    public static function of()
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


    /**
     * @param array $actions
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }
}
