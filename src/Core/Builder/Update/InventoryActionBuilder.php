<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Inventory\Command\InventoryAddQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryChangeQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventoryRemoveQuantityAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetExpectedDeliveryAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetRestockableInDaysAction;
use Commercetools\Core\Request\Inventory\Command\InventorySetSupplyChannelAction;

class InventoryActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#add-quantity
     * @param InventoryAddQuantityAction|callable $action
     * @return $this
     */
    public function addQuantity($action = null)
    {
        $this->addAction($this->resolveAction(InventoryAddQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#change-quantity
     * @param InventoryChangeQuantityAction|callable $action
     * @return $this
     */
    public function changeQuantity($action = null)
    {
        $this->addAction($this->resolveAction(InventoryChangeQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#remove-quantity
     * @param InventoryRemoveQuantityAction|callable $action
     * @return $this
     */
    public function removeQuantity($action = null)
    {
        $this->addAction($this->resolveAction(InventoryRemoveQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-expecteddelivery
     * @param InventorySetExpectedDeliveryAction|callable $action
     * @return $this
     */
    public function setExpectedDelivery($action = null)
    {
        $this->addAction($this->resolveAction(InventorySetExpectedDeliveryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-restockableindays
     * @param InventorySetRestockableInDaysAction|callable $action
     * @return $this
     */
    public function setRestockableInDays($action = null)
    {
        $this->addAction($this->resolveAction(InventorySetRestockableInDaysAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-inventory.html#set-supplychannel
     * @param InventorySetSupplyChannelAction|callable $action
     * @return $this
     */
    public function setSupplyChannel($action = null)
    {
        $this->addAction($this->resolveAction(InventorySetSupplyChannelAction::class, $action));
        return $this;
    }

    /**
     * @return InventoryActionBuilder
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
