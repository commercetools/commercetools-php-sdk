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
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-description
     * @param array $data
     * @return ProductDiscountSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return ProductDiscountSetDescriptionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-value
     * @param array $data
     * @return ProductDiscountChangeValueAction
     */
    public function changeValue(array $data = [])
    {
        return ProductDiscountChangeValueAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-predicate
     * @param array $data
     * @return ProductDiscountChangePredicateAction
     */
    public function changePredicate(array $data = [])
    {
        return ProductDiscountChangePredicateAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-sort-order
     * @param array $data
     * @return ProductDiscountChangeSortOrderAction
     */
    public function changeSortOrder(array $data = [])
    {
        return ProductDiscountChangeSortOrderAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-until
     * @param array $data
     * @return ProductDiscountSetValidUntilAction
     */
    public function setValidUntil(array $data = [])
    {
        return ProductDiscountSetValidUntilAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-name
     * @param array $data
     * @return ProductDiscountChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return ProductDiscountChangeNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-is-active
     * @param array $data
     * @return ProductDiscountChangeIsActiveAction
     */
    public function changeIsActive(array $data = [])
    {
        return ProductDiscountChangeIsActiveAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-from
     * @param array $data
     * @return ProductDiscountSetValidFromAction
     */
    public function setValidFrom(array $data = [])
    {
        return ProductDiscountSetValidFromAction::fromArray($data);
    }

    /**
     * @return ProductDiscountsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
