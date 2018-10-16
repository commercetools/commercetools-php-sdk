<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeDestinationAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionChangeTriggersAction;
use Commercetools\Core\Request\Extensions\Command\ExtensionSetKeyAction;

class ExtensionsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#change-destination
     * @param ExtensionChangeDestinationAction|callable $action
     * @return $this
     */
    public function changeDestination($action = null)
    {
        $this->addAction($this->resolveAction(ExtensionChangeDestinationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#change-triggers
     * @param ExtensionChangeTriggersAction|callable $action
     * @return $this
     */
    public function changeTriggers($action = null)
    {
        $this->addAction($this->resolveAction(ExtensionChangeTriggersAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#set-key
     * @param ExtensionSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ExtensionSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @return ExtensionsActionBuilder
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
