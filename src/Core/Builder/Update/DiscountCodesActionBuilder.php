<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeGroupsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsPerCustomerAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetCartPredicateAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetDescriptionAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidUntilAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetValidFromAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetNameAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeIsActiveAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeSetMaxApplicationsAction;
use Commercetools\Core\Request\DiscountCodes\Command\DiscountCodeChangeCartDiscountsAction;

class DiscountCodesActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-groups
     * @param array $data
     * @return DiscountCodeChangeGroupsAction
     */
    public function changeGroups(array $data = [])
    {
        return new DiscountCodeChangeGroupsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-max-applications-per-customer
     * @param array $data
     * @return DiscountCodeSetMaxApplicationsPerCustomerAction
     */
    public function setMaxApplicationsPerCustomer(array $data = [])
    {
        return new DiscountCodeSetMaxApplicationsPerCustomerAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-cart-predicate
     * @param array $data
     * @return DiscountCodeSetCartPredicateAction
     */
    public function setCartPredicate(array $data = [])
    {
        return new DiscountCodeSetCartPredicateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-description
     * @param array $data
     * @return DiscountCodeSetDescriptionAction
     */
    public function setDescription(array $data = [])
    {
        return new DiscountCodeSetDescriptionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-until
     * @param array $data
     * @return DiscountCodeSetValidUntilAction
     */
    public function setValidUntil(array $data = [])
    {
        return new DiscountCodeSetValidUntilAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-from
     * @param array $data
     * @return DiscountCodeSetValidFromAction
     */
    public function setValidFrom(array $data = [])
    {
        return new DiscountCodeSetValidFromAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-name
     * @param array $data
     * @return DiscountCodeSetNameAction
     */
    public function setName(array $data = [])
    {
        return new DiscountCodeSetNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-isactive
     * @param array $data
     * @return DiscountCodeChangeIsActiveAction
     */
    public function changeIsActive(array $data = [])
    {
        return new DiscountCodeChangeIsActiveAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-max-applications
     * @param array $data
     * @return DiscountCodeSetMaxApplicationsAction
     */
    public function setMaxApplications(array $data = [])
    {
        return new DiscountCodeSetMaxApplicationsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#change-cartdiscounts
     * @param array $data
     * @return DiscountCodeChangeCartDiscountsAction
     */
    public function changeCartDiscounts(array $data = [])
    {
        return new DiscountCodeChangeCartDiscountsAction($data);
    }

    /**
     * @return DiscountCodesActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
