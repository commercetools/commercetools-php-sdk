<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeChangeNameAction;
use Commercetools\Core\Request\Types\Command\TypeRemoveFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeChangeLabelAction;
use Commercetools\Core\Request\Types\Command\TypeChangeKeyAction;
use Commercetools\Core\Request\Types\Command\TypeAddFieldDefinitionAction;
use Commercetools\Core\Request\Types\Command\TypeSetDescriptionAction;
use Commercetools\Core\Request\Types\Command\TypeChangeFieldDefinitionOrderAction;
use Commercetools\Core\Request\Types\Command\TypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\Types\Command\TypeChangeEnumValueOrderAction;
use Commercetools\Core\Request\Types\Command\TypeAddEnumValueAction;

class TypesActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-localizedenumvalues
     * @param TypeChangeLocalizedEnumValueOrderAction|callable $action
     * @return $this
     */
    public function changeLocalizedEnumValueOrder($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeLocalizedEnumValueOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-name
     * @param TypeChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#remove-fielddefinition
     * @param TypeRemoveFieldDefinitionAction|callable $action
     * @return $this
     */
    public function removeFieldDefinition($action = null)
    {
        $this->addAction($this->resolveAction(TypeRemoveFieldDefinitionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-fielddefinition-label
     * @param TypeChangeLabelAction|callable $action
     * @return $this
     */
    public function changeLabel($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeLabelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-key
     * @param TypeChangeKeyAction|callable $action
     * @return $this
     */
    public function changeKey($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-fielddefinition
     * @param TypeAddFieldDefinitionAction|callable $action
     * @return $this
     */
    public function addFieldDefinition($action = null)
    {
        $this->addAction($this->resolveAction(TypeAddFieldDefinitionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#set-description
     * @param TypeSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(TypeSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-fielddefinitions
     * @param TypeChangeFieldDefinitionOrderAction|callable $action
     * @return $this
     */
    public function changeFieldDefinitionOrder($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeFieldDefinitionOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-localizedenumvalue-to-fielddefinition
     * @param TypeAddLocalizedEnumValueAction|callable $action
     * @return $this
     */
    public function addLocalizedEnumValue($action = null)
    {
        $this->addAction($this->resolveAction(TypeAddLocalizedEnumValueAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#change-the-order-of-enumvalues
     * @param TypeChangeEnumValueOrderAction|callable $action
     * @return $this
     */
    public function changeEnumValueOrder($action = null)
    {
        $this->addAction($this->resolveAction(TypeChangeEnumValueOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#add-enumvalue-to-fielddefinition
     * @param TypeAddEnumValueAction|callable $action
     * @return $this
     */
    public function addEnumValue($action = null)
    {
        $this->addAction($this->resolveAction(TypeAddEnumValueAction::class, $action));
        return $this;
    }

    /**
     * @return TypesActionBuilder
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
