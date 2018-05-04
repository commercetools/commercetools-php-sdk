<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeStackingModeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetCustomFieldAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetCustomTypeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;

class CartDiscountsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-cart-predicate
     * @param CartDiscountChangeCartPredicateAction|callable $action
     * @return $this
     */
    public function changeCartPredicate($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeCartPredicateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-isactive
     * @param CartDiscountChangeIsActiveAction|callable $action
     * @return $this
     */
    public function changeIsActive($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeIsActiveAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-name
     * @param CartDiscountChangeNameAction|callable $action
     * @return $this
     */
    public function changeName($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-requires-discountcode
     * @param CartDiscountChangeRequiresDiscountCodeAction|callable $action
     * @return $this
     */
    public function changeRequiresDiscountCode($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeRequiresDiscountCodeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-sort-order
     * @param CartDiscountChangeSortOrderAction|callable $action
     * @return $this
     */
    public function changeSortOrder($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeSortOrderAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-stacking-mode
     * @param CartDiscountChangeStackingModeAction|callable $action
     * @return $this
     */
    public function changeStackingMode($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeStackingModeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-target
     * @param CartDiscountChangeTargetAction|callable $action
     * @return $this
     */
    public function changeTarget($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeTargetAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-value
     * @param CartDiscountChangeValueAction|callable $action
     * @return $this
     */
    public function changeValue($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountChangeValueAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartDiscountSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartDiscountSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-description
     * @param CartDiscountSetDescriptionAction|callable $action
     * @return $this
     */
    public function setDescription($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountSetDescriptionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-from
     * @param CartDiscountSetValidFromAction|callable $action
     * @return $this
     */
    public function setValidFrom($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountSetValidFromAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-until
     * @param CartDiscountSetValidUntilAction|callable $action
     * @return $this
     */
    public function setValidUntil($action = null)
    {
        $this->addAction($this->resolveAction(CartDiscountSetValidUntilAction::class, $action));
        return $this;
    }

    /**
     * @return CartDiscountsActionBuilder
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
