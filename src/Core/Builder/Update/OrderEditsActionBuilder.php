<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditAddStagedActionAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCommentAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetKeyAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetStagedActionsAction;

class OrderEditsActionBuilder
{
    private $actions = [];

    /**
     *
     * @param OrderEditAddStagedActionAction|callable $action
     * @return $this
     */
    public function addStagedAction($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditAddStagedActionAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCommentAction|callable $action
     * @return $this
     */
    public function setComment($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCommentAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetKeyAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetStagedActionsAction|callable $action
     * @return $this
     */
    public function setStagedActions($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetStagedActionsAction::class, $action));
        return $this;
    }

    /**
     * @return OrderEditsActionBuilder
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
