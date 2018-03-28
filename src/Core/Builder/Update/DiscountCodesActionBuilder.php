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
     * @return DiscountCodeChangeGroupsAction
     */
    public function changeGroups()
    {
        return DiscountCodeChangeGroupsAction::of();
    }

    /**
     * @return DiscountCodeSetMaxApplicationsPerCustomerAction
     */
    public function setMaxApplicationsPerCustomer()
    {
        return DiscountCodeSetMaxApplicationsPerCustomerAction::of();
    }

    /**
     * @return DiscountCodeSetCartPredicateAction
     */
    public function setCartPredicate()
    {
        return DiscountCodeSetCartPredicateAction::of();
    }

    /**
     * @return DiscountCodeSetDescriptionAction
     */
    public function setDescription()
    {
        return DiscountCodeSetDescriptionAction::of();
    }

    /**
     * @return DiscountCodeSetValidUntilAction
     */
    public function setValidUntil()
    {
        return DiscountCodeSetValidUntilAction::of();
    }

    /**
     * @return DiscountCodeSetValidFromAction
     */
    public function setValidFrom()
    {
        return DiscountCodeSetValidFromAction::of();
    }

    /**
     * @return DiscountCodeSetNameAction
     */
    public function setName()
    {
        return DiscountCodeSetNameAction::of();
    }

    /**
     * @return DiscountCodeChangeIsActiveAction
     */
    public function changeIsActive()
    {
        return DiscountCodeChangeIsActiveAction::of();
    }

    /**
     * @return DiscountCodeSetMaxApplicationsAction
     */
    public function setMaxApplications()
    {
        return DiscountCodeSetMaxApplicationsAction::of();
    }

    /**
     * @return DiscountCodeChangeCartDiscountsAction
     */
    public function changeCartDiscounts()
    {
        return DiscountCodeChangeCartDiscountsAction::of();
    }
}
