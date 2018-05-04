<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeGroupsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCustomFieldAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCustomTypeAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidFromAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidUntilAction;

class DiscountCodesActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-cartdiscounts
     * @param DiscountCodeChangeCartDiscountsAction|callable $action
     * @return $this
     */
    public function changeCartDiscounts($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeChangeCartDiscountsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-groups
     * @param DiscountCodeChangeGroupsAction|callable $action
     * @return $this
     */
    public function changeGroups($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeChangeGroupsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-isactive
     * @param DiscountCodeChangeIsActiveAction|callable $action
     * @return $this
     */
    public function changeIsActive($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeChangeIsActiveAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-cart-predicate
     * @param DiscountCodeSetCartPredicateAction|callable $action
     * @return $this
     */
    public function setCartPredicate($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetCartPredicateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param DiscountCodeSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param DiscountCodeSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-description
     * @param DiscountCodeSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-max-applications
     * @param DiscountCodeSetMaxApplicationsAction|callable $action
     * @return $this
     */
    public function setMaxApplications($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetMaxApplicationsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-max-applications-per-customer
     * @param DiscountCodeSetMaxApplicationsPerCustomerAction|callable $action
     * @return $this
     */
    public function setMaxApplicationsPerCustomer($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetMaxApplicationsPerCustomerAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-name
     * @param DiscountCodeSetNameAction|callable $action
     * @return $this
     */
    public function setName($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-from
     * @param DiscountCodeSetValidFromAction|callable $action
     * @return $this
     */
    public function setValidFrom($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetValidFromAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-until
     * @param DiscountCodeSetValidUntilAction|callable $action
     * @return $this
     */
    public function setValidUntil($action = null)
    {
        $this->addAction($this->resolveAction(DiscountCodeSetValidUntilAction::class, $action));
        return $this;
    }

    /**
     * @return DiscountCodesActionBuilder
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
