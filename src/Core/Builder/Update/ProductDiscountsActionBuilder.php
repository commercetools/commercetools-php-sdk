<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetDescriptionAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeValueAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangePredicateAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeSortOrderAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidUntilAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeNameAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountChangeIsActiveAction;
use Commercetools\Core\Request\ProductDiscounts\Command\ProductDiscountSetValidFromAction;

class ProductDiscountsActionBuilder
{
    /**
     * @return ProductDiscountSetDescriptionAction
     */
    public function setDescription()
    {
        return ProductDiscountSetDescriptionAction::of();
    }

    /**
     * @return ProductDiscountChangeValueAction
     */
    public function changeValue()
    {
        return ProductDiscountChangeValueAction::of();
    }

    /**
     * @return ProductDiscountChangePredicateAction
     */
    public function changePredicate()
    {
        return ProductDiscountChangePredicateAction::of();
    }

    /**
     * @return ProductDiscountChangeSortOrderAction
     */
    public function changeSortOrder()
    {
        return ProductDiscountChangeSortOrderAction::of();
    }

    /**
     * @return ProductDiscountSetValidUntilAction
     */
    public function setValidUntil()
    {
        return ProductDiscountSetValidUntilAction::of();
    }

    /**
     * @return ProductDiscountChangeNameAction
     */
    public function changeName()
    {
        return ProductDiscountChangeNameAction::of();
    }

    /**
     * @return ProductDiscountChangeIsActiveAction
     */
    public function changeIsActive()
    {
        return ProductDiscountChangeIsActiveAction::of();
    }

    /**
     * @return ProductDiscountSetValidFromAction
     */
    public function setValidFrom()
    {
        return ProductDiscountSetValidFromAction::of();
    }
}
