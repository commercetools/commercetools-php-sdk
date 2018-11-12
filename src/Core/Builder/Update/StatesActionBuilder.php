<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\States\Command\StateAddRolesAction;
use Commercetools\Core\Request\States\Command\StateChangeInitialAction;
use Commercetools\Core\Request\States\Command\StateChangeKeyAction;
use Commercetools\Core\Request\States\Command\StateChangeTypeAction;
use Commercetools\Core\Request\States\Command\StateRemoveRolesAction;
use Commercetools\Core\Request\States\Command\StateSetDescriptionAction;
use Commercetools\Core\Request\States\Command\StateSetNameAction;
use Commercetools\Core\Request\States\Command\StateSetRolesAction;
use Commercetools\Core\Request\States\Command\StateSetTransitionsAction;
use Commercetools\Core\Request\States\Command\TransitionStateAction;

class StatesActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#add-state-roles
     * @param StateAddRolesAction|callable $action
     * @return $this
     */
    public function addRoles($action = null)
    {
        $this->addAction($this->resolveAction(StateAddRolesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-initial-state
     * @param StateChangeInitialAction|callable $action
     * @return $this
     */
    public function changeInitial($action = null)
    {
        $this->addAction($this->resolveAction(StateChangeInitialAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-state-key
     * @param StateChangeKeyAction|callable $action
     * @return $this
     */
    public function changeKey($action = null)
    {
        $this->addAction($this->resolveAction(StateChangeKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#change-state-type
     * @param StateChangeTypeAction|callable $action
     * @return $this
     */
    public function changeType($action = null)
    {
        $this->addAction($this->resolveAction(StateChangeTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#remove-state-roles
     * @param StateRemoveRolesAction|callable $action
     * @return $this
     */
    public function removeRoles($action = null)
    {
        $this->addAction($this->resolveAction(StateRemoveRolesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-description
     * @param StateSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(StateSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-name
     * @param StateSetNameAction|callable $action
     * @return $this
     */
    public function setName($action = null)
    {
        $this->addAction($this->resolveAction(StateSetNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-roles
     * @param StateSetRolesAction|callable $action
     * @return $this
     */
    public function setRoles($action = null)
    {
        $this->addAction($this->resolveAction(StateSetRolesAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#set-transitions
     * @param StateSetTransitionsAction|callable $action
     * @return $this
     */
    public function setTransitions($action = null)
    {
        $this->addAction($this->resolveAction(StateSetTransitionsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param TransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(TransitionStateAction::class, $action));
        return $this;
    }

    /**
     * @return StatesActionBuilder
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
