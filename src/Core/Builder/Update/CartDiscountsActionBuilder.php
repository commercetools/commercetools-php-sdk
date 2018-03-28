<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeStackingModeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;

class CartDiscountsActionBuilder
{
    /**
     * @return CartDiscountChangeNameAction
     */
    public function changeName()
    {
        return CartDiscountChangeNameAction::of();
    }

    /**
     * @return CartDiscountChangeStackingModeAction
     */
    public function changeStackingMode()
    {
        return CartDiscountChangeStackingModeAction::of();
    }

    /**
     * @return CartDiscountChangeCartPredicateAction
     */
    public function changeCartPredicate()
    {
        return CartDiscountChangeCartPredicateAction::of();
    }

    /**
     * @return CartDiscountChangeRequiresDiscountCodeAction
     */
    public function changeRequiresDiscountCode()
    {
        return CartDiscountChangeRequiresDiscountCodeAction::of();
    }

    /**
     * @return CartDiscountSetValidUntilAction
     */
    public function setValidUntil()
    {
        return CartDiscountSetValidUntilAction::of();
    }

    /**
     * @return CartDiscountSetDescriptionAction
     */
    public function setDescription()
    {
        return CartDiscountSetDescriptionAction::of();
    }

    /**
     * @return CartDiscountChangeSortOrderAction
     */
    public function changeSortOrder()
    {
        return CartDiscountChangeSortOrderAction::of();
    }

    /**
     * @return CartDiscountSetValidFromAction
     */
    public function setValidFrom()
    {
        return CartDiscountSetValidFromAction::of();
    }

    /**
     * @return CartDiscountChangeIsActiveAction
     */
    public function changeIsActive()
    {
        return CartDiscountChangeIsActiveAction::of();
    }

    /**
     * @return CartDiscountChangeValueAction
     */
    public function changeValue()
    {
        return CartDiscountChangeValueAction::of();
    }

    /**
     * @return CartDiscountChangeTargetAction
     */
    public function changeTarget()
    {
        return CartDiscountChangeTargetAction::of();
    }
}
