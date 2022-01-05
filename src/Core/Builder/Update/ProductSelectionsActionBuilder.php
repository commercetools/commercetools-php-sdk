<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionAddProductAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionChangeNameAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionRemoveProductAction;
use Commercetools\Core\Request\ProductSelections\Command\ProductSelectionSetKeyAction;

class ProductSelectionsActionBuilder
{
    private $actions = [];

    /**
     *
     * @param ProductSelectionAddProductAction|callable $action
     * @return $this
     */
    public function addProduct($action = null)
    {
        $this->addAction($this->resolveAction(ProductSelectionAddProductAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ProductSelectionChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ProductSelectionChangeNameAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ProductSelectionRemoveProductAction|callable $action
     * @return $this
     */
    public function removeProduct($action = null)
    {
        $this->addAction($this->resolveAction(ProductSelectionRemoveProductAction::class, $action));
        return $this;
    }

    /**
     *
     * @param ProductSelectionSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ProductSelectionSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @return ProductSelectionsActionBuilder
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
