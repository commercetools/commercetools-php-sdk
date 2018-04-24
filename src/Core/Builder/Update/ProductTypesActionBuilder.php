<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetInputTipAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumLabelAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddPlainEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeRemoveAttributeDefinitionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangePlainEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeSetKeyAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeDescriptionAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeConstraintAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeNameAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeLocalizedEnumValueOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeIsSearchableAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeAttributeOrderAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeAddLocalizedEnumValueAction;
use Commercetools\Core\Request\ProductTypes\Command\ProductTypeChangeInputHintAction;

class ProductTypesActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-localizedenumvalue
     * @param ProductTypeChangeLocalizedEnumLabelAction|callable $action
     * @return $this
     */
    public function changeLocalizedEnumValueLabel($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeLocalizedEnumLabelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-attributedefinition-inputtip
     * @param ProductTypeSetInputTipAction|callable $action
     * @return $this
     */
    public function setInputTip($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeSetInputTipAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-label
     * @param ProductTypeChangeLabelAction|callable $action
     * @return $this
     */
    public function changeLabel($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeLabelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-attributedefinition
     * @param ProductTypeAddAttributeDefinitionAction|callable $action
     * @return $this
     */
    public function addAttributeDefinition($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeAddAttributeDefinitionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-label-of-an-enumvalue
     * @param ProductTypeChangePlainEnumLabelAction|callable $action
     * @return $this
     */
    public function changePlainEnumValueLabel($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangePlainEnumLabelAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-plainenumvalue-to-attributedefinition
     * @param ProductTypeAddPlainEnumValueAction|callable $action
     * @return $this
     */
    public function addPlainEnumValue($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeAddPlainEnumValueAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#remove-attributedefinition
     * @param ProductTypeRemoveAttributeDefinitionAction|callable $action
     * @return $this
     */
    public function removeAttributeDefinition($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeRemoveAttributeDefinitionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-enumvalues
     * @param ProductTypeChangePlainEnumValueOrderAction|callable $action
     * @return $this
     */
    public function changePlainEnumValueOrder($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangePlainEnumValueOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#set-key
     * @param ProductTypeSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-description
     * @param ProductTypeChangeDescriptionAction|callable $action
     * @return $this
     */
    public function changeDescription($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-attributeconstraint
     * @param ProductTypeChangeAttributeConstraintAction|callable $action
     * @return $this
     */
    public function changeAttributeConstraint($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeAttributeConstraintAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-name
     * @param ProductTypeChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-localizedenumvalues
     * @param ProductTypeChangeLocalizedEnumValueOrderAction|callable $action
     * @return $this
     */
    public function changeLocalizedEnumValueOrder($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeLocalizedEnumValueOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-issearchable
     * @param ProductTypeChangeIsSearchableAction|callable $action
     * @return $this
     */
    public function changeIsSearchable($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeIsSearchableAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-order-of-attributedefinitions
     * @param ProductTypeChangeAttributeOrderAction|callable $action
     * @return $this
     */
    public function changeAttributeOrder($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeAttributeOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#add-localizableenumvalue-to-attributedefinition
     * @param ProductTypeAddLocalizedEnumValueAction|callable $action
     * @return $this
     */
    public function addLocalizedEnumValue($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeAddLocalizedEnumValueAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-inputhint
     * @param ProductTypeChangeInputHintAction|callable $action
     * @return $this
     */
    public function changeInputHint($action = null)
    {
        $this->addAction($this->resolveAction(ProductTypeChangeInputHintAction::class, $action));
        return $this;
    }

    /**
     * @return ProductTypesActionBuilder
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
