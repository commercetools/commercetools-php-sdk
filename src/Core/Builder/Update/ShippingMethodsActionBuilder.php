<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodAddZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeIsDefaultAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeNameAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodChangeTaxCategoryAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveShippingRateAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodRemoveZoneAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetDescriptionAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetKeyAction;
use Commercetools\Core\Request\ShippingMethods\Command\ShippingMethodSetPredicateAction;

class ShippingMethodsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#add-shippingrate
     * @param ShippingMethodAddShippingRateAction|callable $action
     * @return $this
     */
    public function addShippingRate($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodAddShippingRateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#add-zone
     * @param ShippingMethodAddZoneAction|callable $action
     * @return $this
     */
    public function addZone($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodAddZoneAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-isdefault
     * @param ShippingMethodChangeIsDefaultAction|callable $action
     * @return $this
     */
    public function changeIsDefault($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodChangeIsDefaultAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-name
     * @param ShippingMethodChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#change-taxcategory
     * @param ShippingMethodChangeTaxCategoryAction|callable $action
     * @return $this
     */
    public function changeTaxCategory($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodChangeTaxCategoryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#remove-shippingrate
     * @param ShippingMethodRemoveShippingRateAction|callable $action
     * @return $this
     */
    public function removeShippingRate($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodRemoveShippingRateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#remove-zone
     * @param ShippingMethodRemoveZoneAction|callable $action
     * @return $this
     */
    public function removeZone($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodRemoveZoneAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-description
     * @param ShippingMethodSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-key
     * @param ShippingMethodSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-predicate
     * @param ShippingMethodSetPredicateAction|callable $action
     * @return $this
     */
    public function setPredicate($action = null)
    {
        $this->addAction($this->resolveAction(ShippingMethodSetPredicateAction::class, $action));
        return $this;
    }

    /**
     * @return ShippingMethodsActionBuilder
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
