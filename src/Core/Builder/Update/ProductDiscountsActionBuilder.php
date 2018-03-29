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
        return new ProductDiscountSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-value
     * @param array $data
     * @return ProductDiscountChangeValueAction
     */
    public function changeValue(array $data = [])
    {
        return new ProductDiscountChangeValueAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-predicate
     * @param array $data
     * @return ProductDiscountChangePredicateAction
     */
    public function changePredicate(array $data = [])
    {
        return new ProductDiscountChangePredicateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-sort-order
     * @param array $data
     * @return ProductDiscountChangeSortOrderAction
     */
    public function changeSortOrder(array $data = [])
    {
        return new ProductDiscountChangeSortOrderAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-until
     * @param array $data
     * @return ProductDiscountSetValidUntilAction
     */
    public function setValidUntil(array $data = [])
    {
        return new ProductDiscountSetValidUntilAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-name
     * @param array $data
     * @return ProductDiscountChangeNameAction
     */
    public function changeName(array $data = [])
    {
        return new ProductDiscountChangeNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#change-is-active
     * @param array $data
     * @return ProductDiscountChangeIsActiveAction
     */
    public function changeIsActive(array $data = [])
    {
        return new ProductDiscountChangeIsActiveAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-from
     * @param array $data
     * @return ProductDiscountSetValidFromAction
     */
    public function setValidFrom(array $data = [])
    {
        return new ProductDiscountSetValidFromAction($data);
    }

    /**
     * @return ProductDiscountsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
