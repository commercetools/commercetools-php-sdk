<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidFromAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidFromAndUntilAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidUntilAction;

class ProductDiscountsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-is-active
     * @param ProductDiscountChangeIsActiveAction|callable $action
     * @return $this
     */
    public function changeIsActive($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountChangeIsActiveAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-name
     * @param ProductDiscountChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-predicate
     * @param ProductDiscountChangePredicateAction|callable $action
     * @return $this
     */
    public function changePredicate($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountChangePredicateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-sort-order
     * @param ProductDiscountChangeSortOrderAction|callable $action
     * @return $this
     */
    public function changeSortOrder($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountChangeSortOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-value
     * @param ProductDiscountChangeValueAction|callable $action
     * @return $this
     */
    public function changeValue($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountChangeValueAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-description
     * @param ProductDiscountSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-from
     * @param ProductDiscountSetValidFromAction|callable $action
     * @return $this
     */
    public function setValidFrom($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountSetValidFromAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-from-and-until
     * @param ProductDiscountSetValidFromAndUntilAction|callable $action
     * @return $this
     */
    public function setValidFromAndUntil($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountSetValidFromAndUntilAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-until
     * @param ProductDiscountSetValidUntilAction|callable $action
     * @return $this
     */
    public function setValidUntil($action = null)
    {
        $this->addAction($this->resolveAction(ProductDiscountSetValidUntilAction::class, $action));
        return $this;
    }

    /**
     * @return ProductDiscountsActionBuilder
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
