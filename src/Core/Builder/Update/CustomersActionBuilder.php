<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomFieldAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomTypeAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetFirstNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetKeyAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLastNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLocaleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetMiddleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetSalutationAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;

class CustomersActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-address
     * @param CustomerAddAddressAction|callable $action
     * @return $this
     */
    public function addAddress($action = null)
    {
        $this->addAction($this->resolveAction(CustomerAddAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param CustomerAddBillingAddressAction|callable $action
     * @return $this
     */
    public function addBillingAddressId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerAddBillingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param CustomerAddShippingAddressAction|callable $action
     * @return $this
     */
    public function addShippingAddressId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerAddShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#change-address
     * @param CustomerChangeAddressAction|callable $action
     * @return $this
     */
    public function changeAddress($action = null)
    {
        $this->addAction($this->resolveAction(CustomerChangeAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#change-email
     * @param CustomerChangeEmailAction|callable $action
     * @return $this
     */
    public function changeEmail($action = null)
    {
        $this->addAction($this->resolveAction(CustomerChangeEmailAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#remove-address
     * @param CustomerRemoveAddressAction|callable $action
     * @return $this
     */
    public function removeAddress($action = null)
    {
        $this->addAction($this->resolveAction(CustomerRemoveAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param CustomerRemoveBillingAddressAction|callable $action
     * @return $this
     */
    public function removeBillingAddressId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerRemoveBillingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
     * @param CustomerRemoveShippingAddressAction|callable $action
     * @return $this
     */
    public function removeShippingAddressId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerRemoveShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-company-name
     * @param CustomerSetCompanyNameAction|callable $action
     * @return $this
     */
    public function setCompanyName($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetCompanyNameAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CustomerSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CustomerSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-customergroup
     * @param CustomerSetCustomerGroupAction|callable $action
     * @return $this
     */
    public function setCustomerGroup($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetCustomerGroupAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-customer-number
     * @param CustomerSetCustomerNumberAction|callable $action
     * @return $this
     */
    public function setCustomerNumber($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetCustomerNumberAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-date-of-birth
     * @param CustomerSetDateOfBirthAction|callable $action
     * @return $this
     */
    public function setDateOfBirth($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetDateOfBirthAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-default-billing-address
     * @param CustomerSetDefaultBillingAddressAction|callable $action
     * @return $this
     */
    public function setDefaultBillingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetDefaultBillingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-default-shipping-address
     * @param CustomerSetDefaultShippingAddressAction|callable $action
     * @return $this
     */
    public function setDefaultShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetDefaultShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-external-id
     * @param CustomerSetExternalIdAction|callable $action
     * @return $this
     */
    public function setExternalId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetExternalIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-first-name
     * @param CustomerSetFirstNameAction|callable $action
     * @return $this
     */
    public function setFirstName($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetFirstNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-key
     * @param CustomerSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-last-name
     * @param CustomerSetLastNameAction|callable $action
     * @return $this
     */
    public function setLastName($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetLastNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-locale
     * @param CustomerSetLocaleAction|callable $action
     * @return $this
     */
    public function setLocale($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetLocaleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-middle-name
     * @param CustomerSetMiddleNameAction|callable $action
     * @return $this
     */
    public function setMiddleName($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetMiddleNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-salutation
     * @param CustomerSetSalutationAction|callable $action
     * @return $this
     */
    public function setSalutation($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetSalutationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-title
     * @param CustomerSetTitleAction|callable $action
     * @return $this
     */
    public function setTitle($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetTitleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#set-vat-id
     * @param CustomerSetVatIdAction|callable $action
     * @return $this
     */
    public function setVatId($action = null)
    {
        $this->addAction($this->resolveAction(CustomerSetVatIdAction::class, $action));
        return $this;
    }

    /**
     * @return CustomersActionBuilder
     */
    public static function of()
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
