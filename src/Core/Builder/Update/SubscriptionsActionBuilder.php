<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetChangesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetMessagesAction;
use Commercetools\Core\Request\Subscriptions\Command\SubscriptionSetKeyAction;

class SubscriptionsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-changes
     * @param SubscriptionSetChangesAction|callable $action
     * @return $this
     */
    public function setChanges($action = null)
    {
        $this->addAction($this->resolveAction(SubscriptionSetChangesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-messages
     * @param SubscriptionSetMessagesAction|callable $action
     * @return $this
     */
    public function setMessages($action = null)
    {
        $this->addAction($this->resolveAction(SubscriptionSetMessagesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-subscriptions.html#set-key
     * @param SubscriptionSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(SubscriptionSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @return SubscriptionsActionBuilder
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
