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
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-default-shipping-address
     * @param array $data
     * @return CustomerSetDefaultShippingAddressAction
     */
    public function setDefaultShippingAddress(array $data = [])
    {
        return CustomerSetDefaultShippingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-title
     * @param array $data
     * @return CustomerSetTitleAction
     */
    public function setTitle(array $data = [])
    {
        return CustomerSetTitleAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-customergroup
     * @param array $data
     * @return CustomerSetCustomerGroupAction
     */
    public function setCustomerGroup(array $data = [])
    {
        return CustomerSetCustomerGroupAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-date-of-birth
     * @param array $data
     * @return CustomerSetDateOfBirthAction
     */
    public function setDateOfBirth(array $data = [])
    {
        return CustomerSetDateOfBirthAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#change-email
     * @param array $data
     * @return CustomerChangeEmailAction
     */
    public function changeEmail(array $data = [])
    {
        return CustomerChangeEmailAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-last-name
     * @param array $data
     * @return CustomerSetLastNameAction
     */
    public function setLastName(array $data = [])
    {
        return CustomerSetLastNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-salutation
     * @param array $data
     * @return CustomerSetSalutationAction
     */
    public function setSalutation(array $data = [])
    {
        return CustomerSetSalutationAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-vat-id
     * @param array $data
     * @return CustomerSetVatIdAction
     */
    public function setVatId(array $data = [])
    {
        return CustomerSetVatIdAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-key
     * @param array $data
     * @return CustomerSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return CustomerSetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-locale
     * @param array $data
     * @return CustomerSetLocaleAction
     */
    public function setLocale(array $data = [])
    {
        return CustomerSetLocaleAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-first-name
     * @param array $data
     * @return CustomerSetFirstNameAction
     */
    public function setFirstName(array $data = [])
    {
        return CustomerSetFirstNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-company-name
     * @param array $data
     * @return CustomerSetCompanyNameAction
     */
    public function setCompanyName(array $data = [])
    {
        return CustomerSetCompanyNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#remove-address
     * @param array $data
     * @return CustomerRemoveAddressAction
     */
    public function removeAddress(array $data = [])
    {
        return CustomerRemoveAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param array $data
     * @return CustomerRemoveBillingAddressAction
     */
    public function removeBillingAddressId(array $data = [])
    {
        return CustomerRemoveBillingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param array $data
     * @return CustomerAddBillingAddressAction
     */
    public function addBillingAddressId(array $data = [])
    {
        return CustomerAddBillingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param array $data
     * @return CustomerRemoveShippingAddressAction
     */
    public function removeShippingAddressId(array $data = [])
    {
        return CustomerRemoveShippingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-address
     * @param array $data
     * @return CustomerAddAddressAction
     */
    public function addAddress(array $data = [])
    {
        return CustomerAddAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-middle-name
     * @param array $data
     * @return CustomerSetMiddleNameAction
     */
    public function setMiddleName(array $data = [])
    {
        return CustomerSetMiddleNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-default-billing-address
     * @param array $data
     * @return CustomerSetDefaultBillingAddressAction
     */
    public function setDefaultBillingAddress(array $data = [])
    {
        return CustomerSetDefaultBillingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#change-address
     * @param array $data
     * @return CustomerChangeAddressAction
     */
    public function changeAddress(array $data = [])
    {
        return CustomerChangeAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-external-id
     * @param array $data
     * @return CustomerSetExternalIdAction
     */
    public function setExternalId(array $data = [])
    {
        return CustomerSetExternalIdAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param array $data
     * @return CustomerAddShippingAddressAction
     */
    public function addShippingAddressId(array $data = [])
    {
        return CustomerAddShippingAddressAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-customer-number
     * @param array $data
     * @return CustomerSetCustomerNumberAction
     */
    public function setCustomerNumber(array $data = [])
    {
        return CustomerSetCustomerNumberAction::fromArray($data);
    }

    /**
     * @return CustomersActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
