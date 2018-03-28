<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLastNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetSalutationAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetKeyAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLocaleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetFirstNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetMiddleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction;

class CustomersActionBuilder
{
    /**
     * @return CustomerSetDefaultShippingAddressAction
     */
    public function setDefaultShippingAddress()
    {
        return CustomerSetDefaultShippingAddressAction::of();
    }

    /**
     * @return CustomerSetTitleAction
     */
    public function setTitle()
    {
        return CustomerSetTitleAction::of();
    }

    /**
     * @return CustomerSetCustomerGroupAction
     */
    public function setCustomerGroup()
    {
        return CustomerSetCustomerGroupAction::of();
    }

    /**
     * @return CustomerSetDateOfBirthAction
     */
    public function setDateOfBirth()
    {
        return CustomerSetDateOfBirthAction::of();
    }

    /**
     * @return CustomerChangeEmailAction
     */
    public function changeEmail()
    {
        return CustomerChangeEmailAction::of();
    }

    /**
     * @return CustomerSetLastNameAction
     */
    public function setLastName()
    {
        return CustomerSetLastNameAction::of();
    }

    /**
     * @return CustomerSetSalutationAction
     */
    public function setSalutation()
    {
        return CustomerSetSalutationAction::of();
    }

    /**
     * @return CustomerSetVatIdAction
     */
    public function setVatId()
    {
        return CustomerSetVatIdAction::of();
    }

    /**
     * @return CustomerSetKeyAction
     */
    public function setKey()
    {
        return CustomerSetKeyAction::of();
    }

    /**
     * @return CustomerSetLocaleAction
     */
    public function setLocale()
    {
        return CustomerSetLocaleAction::of();
    }

    /**
     * @return CustomerSetFirstNameAction
     */
    public function setFirstName()
    {
        return CustomerSetFirstNameAction::of();
    }

    /**
     * @return CustomerSetCompanyNameAction
     */
    public function setCompanyName()
    {
        return CustomerSetCompanyNameAction::of();
    }

    /**
     * @return CustomerRemoveAddressAction
     */
    public function removeAddress()
    {
        return CustomerRemoveAddressAction::of();
    }

    /**
     * @return CustomerRemoveBillingAddressAction
     */
    public function removeBillingAddressId()
    {
        return CustomerRemoveBillingAddressAction::of();
    }

    /**
     * @return CustomerAddBillingAddressAction
     */
    public function addBillingAddressId()
    {
        return CustomerAddBillingAddressAction::of();
    }

    /**
     * @return CustomerRemoveShippingAddressAction
     */
    public function removeShippingAddressId()
    {
        return CustomerRemoveShippingAddressAction::of();
    }

    /**
     * @return CustomerAddAddressAction
     */
    public function addAddress()
    {
        return CustomerAddAddressAction::of();
    }

    /**
     * @return CustomerSetMiddleNameAction
     */
    public function setMiddleName()
    {
        return CustomerSetMiddleNameAction::of();
    }

    /**
     * @return CustomerSetDefaultBillingAddressAction
     */
    public function setDefaultBillingAddress()
    {
        return CustomerSetDefaultBillingAddressAction::of();
    }

    /**
     * @return CustomerChangeAddressAction
     */
    public function changeAddress()
    {
        return CustomerChangeAddressAction::of();
    }

    /**
     * @return CustomerSetExternalIdAction
     */
    public function setExternalId()
    {
        return CustomerSetExternalIdAction::of();
    }

    /**
     * @return CustomerAddShippingAddressAction
     */
    public function addShippingAddressId()
    {
        return CustomerAddShippingAddressAction::of();
    }

    /**
     * @return CustomerSetCustomerNumberAction
     */
    public function setCustomerNumber()
    {
        return CustomerSetCustomerNumberAction::of();
    }
}
