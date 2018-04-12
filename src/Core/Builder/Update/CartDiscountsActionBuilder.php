<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeCartPredicateAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeIsActiveAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeNameAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeRequiresDiscountCodeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeSortOrderAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeStackingModeAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeTargetAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountChangeValueAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetDescriptionAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidFromAction;
use Commercetools\Core\Request\CartDiscounts\Command\CartDiscountSetValidUntilAction;

class CartDiscountsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-cart-predicate
     * @param array $data
     * @return CartDiscountChangeCartPredicateAction
     */
    public function changeCartPredicate(array $data = [])
    {
        return CartDiscountChangeCartPredicateAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-isactive
     * @param array $data
     * @return CartDiscountChangeIsActiveAction
     */
    public function changeIsActive(array $data = [])
    {
        return CartDiscountChangeIsActiveAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-name
     * @param array $data
     * @return CartDiscountChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return CartDiscountChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-requires-discountcode
     * @param array $data
     * @return CartDiscountChangeRequiresDiscountCodeAction
     */
    public function changeRequiresDiscountCode(array $data = [])
    {
        return CartDiscountChangeRequiresDiscountCodeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-sort-order
     * @param array $data
     * @return CartDiscountChangeSortOrderAction
     */
    public function changeSortOrder(array $data = [])
    {
        return CartDiscountChangeSortOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-stacking-mode
     * @param array $data
     * @return CartDiscountChangeStackingModeAction
     */
    public function changeStackingMode(array $data = [])
    {
        return CartDiscountChangeStackingModeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-target
     * @param array $data
     * @return CartDiscountChangeTargetAction
     */
    public function changeTarget(array $data = [])
    {
        return CartDiscountChangeTargetAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-value
     * @param array $data
     * @return CartDiscountChangeValueAction
     */
    public function changeValue(array $data = [])
    {
        return CartDiscountChangeValueAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-description
     * @param array $data
     * @return CartDiscountSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return CartDiscountSetDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-from
     * @param array $data
     * @return CartDiscountSetValidFromAction
     */
    public function setValidFrom(array $data = [])
    {
        return CartDiscountSetValidFromAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-until
     * @param array $data
     * @return CartDiscountSetValidUntilAction
     */
    public function setValidUntil(array $data = [])
    {
        return CartDiscountSetValidUntilAction::fromArray($data);
    }

    /**
     * @return CartDiscountsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
