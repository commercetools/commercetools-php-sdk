<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartAddItemShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartAddPaymentAction;
use Commercetools\Core\Request\Carts\Command\CartAddShoppingListAction;
use Commercetools\Core\Request\Carts\Command\CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction;
use Commercetools\Core\Request\Carts\Command\CartApplyDeltaToLineItemShippingDetailsTargetsAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxCalculationModeAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxModeAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxRoundingModeAction;
use Commercetools\Core\Request\Carts\Command\CartRecalculateAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveItemShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction;
use Commercetools\Core\Request\Carts\Command\CartSetAnonymousIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressCustomField;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressCustomType;
use Commercetools\Core\Request\Carts\Command\CartSetCartTotalTaxAction;
use Commercetools\Core\Request\Carts\Command\CartSetCountryAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerGroupAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTotalPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetLocaleAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressCustomField;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressCustomType;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingRateInputAction;
use Commercetools\Core\Request\Carts\Command\CartUpdateItemShippingAddressAction;

class CartsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-customlineitem
     * @param CartAddCustomLineItemAction|callable $action
     * @return $this
     */
    public function addCustomLineItem($action = null)
    {
        $this->addAction($this->resolveAction(CartAddCustomLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-discountcode
     * @param CartAddDiscountCodeAction|callable $action
     * @return $this
     */
    public function addDiscountCode($action = null)
    {
        $this->addAction($this->resolveAction(CartAddDiscountCodeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-itemshippingaddress
     * @param CartAddItemShippingAddressAction|callable $action
     * @return $this
     */
    public function addItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CartAddItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-lineitem
     * @param CartAddLineItemAction|callable $action
     * @return $this
     */
    public function addLineItem($action = null)
    {
        $this->addAction($this->resolveAction(CartAddLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-payment
     * @param CartAddPaymentAction|callable $action
     * @return $this
     */
    public function addPayment($action = null)
    {
        $this->addAction($this->resolveAction(CartAddPaymentAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-shoppinglist
     * @param CartAddShoppingListAction|callable $action
     * @return $this
     */
    public function addShoppingList($action = null)
    {
        $this->addAction($this->resolveAction(CartAddShoppingListAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#apply-deltatocustomlineitemshippingdetailstargets
     * @param CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction|callable $action
     * @return $this
     */
    public function applyDeltaToCustomLineItemShippingDetailsTargets($action = null)
    {
        // phpcs:ignore
        $this->addAction($this->resolveAction(CartApplyDeltaToCustomLineItemShippingDetailsTargetsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#apply-deltatolineitemshippingdetailstargets
     * @param CartApplyDeltaToLineItemShippingDetailsTargetsAction|callable $action
     * @return $this
     */
    public function applyDeltaToLineItemShippingDetailsTargets($action = null)
    {
        $this->addAction($this->resolveAction(CartApplyDeltaToLineItemShippingDetailsTargetsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-customlineitem-money
     * @param CartChangeCustomLineItemMoneyAction|callable $action
     * @return $this
     */
    public function changeCustomLineItemMoney($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeCustomLineItemMoneyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-customlineitem-quantity
     * @param CartChangeCustomLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeCustomLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeCustomLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-lineitem-quantity
     * @param CartChangeLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-tax-calculationmode
     * @param CartChangeTaxCalculationModeAction|callable $action
     * @return $this
     */
    public function changeTaxCalculationMode($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeTaxCalculationModeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-taxmode
     * @param CartChangeTaxModeAction|callable $action
     * @return $this
     */
    public function changeTaxMode($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeTaxModeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-tax-roundingmode
     * @param CartChangeTaxRoundingModeAction|callable $action
     * @return $this
     */
    public function changeTaxRoundingMode($action = null)
    {
        $this->addAction($this->resolveAction(CartChangeTaxRoundingModeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#recalculate
     * @param CartRecalculateAction|callable $action
     * @return $this
     */
    public function recalculate($action = null)
    {
        $this->addAction($this->resolveAction(CartRecalculateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-customlineitem
     * @param CartRemoveCustomLineItemAction|callable $action
     * @return $this
     */
    public function removeCustomLineItem($action = null)
    {
        $this->addAction($this->resolveAction(CartRemoveCustomLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-discountcode
     * @param CartRemoveDiscountCodeAction|callable $action
     * @return $this
     */
    public function removeDiscountCode($action = null)
    {
        $this->addAction($this->resolveAction(CartRemoveDiscountCodeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-itemshippingaddress
     * @param CartRemoveItemShippingAddressAction|callable $action
     * @return $this
     */
    public function removeItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CartRemoveItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-lineitem
     * @param CartRemoveLineItemAction|callable $action
     * @return $this
     */
    public function removeLineItem($action = null)
    {
        $this->addAction($this->resolveAction(CartRemoveLineItemAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-payment
     * @param CartRemovePaymentAction|callable $action
     * @return $this
     */
    public function removePayment($action = null)
    {
        $this->addAction($this->resolveAction(CartRemovePaymentAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-anonymous-id
     * @param CartSetAnonymousIdAction|callable $action
     * @return $this
     */
    public function setAnonymousId($action = null)
    {
        $this->addAction($this->resolveAction(CartSetAnonymousIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-billing-address
     * @param CartSetBillingAddressAction|callable $action
     * @return $this
     */
    public function setBillingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CartSetBillingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetBillingAddressCustomField|callable $action
     * @return $this
     */
    public function setBillingAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartSetBillingAddressCustomField::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetBillingAddressCustomType|callable $action
     * @return $this
     */
    public function setBillingAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartSetBillingAddressCustomType::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-cart-total-tax
     * @param CartSetCartTotalTaxAction|callable $action
     * @return $this
     */
    public function setCartTotalTax($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCartTotalTaxAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-country
     * @param CartSetCountryAction|callable $action
     * @return $this
     */
    public function setCountry($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCountryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-customfield
     * @param CartSetCustomLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
     * @param CartSetCustomLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitemshippingdetails
     * @param CartSetCustomLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setCustomLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxamount
     * @param CartSetCustomLineItemTaxAmountAction|callable $action
     * @return $this
     */
    public function setCustomLineItemTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomLineItemTaxAmountAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxrate
     * @param CartSetCustomLineItemTaxRateAction|callable $action
     * @return $this
     */
    public function setCustomLineItemTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomLineItemTaxRateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-custom-shippingmethod
     * @param CartSetCustomShippingMethodAction|callable $action
     * @return $this
     */
    public function setCustomShippingMethod($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomShippingMethodAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-email
     * @param CartSetCustomerEmailAction|callable $action
     * @return $this
     */
    public function setCustomerEmail($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomerEmailAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-group
     * @param CartSetCustomerGroupAction|callable $action
     * @return $this
     */
    public function setCustomerGroup($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomerGroupAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-id
     * @param CartSetCustomerIdAction|callable $action
     * @return $this
     */
    public function setCustomerId($action = null)
    {
        $this->addAction($this->resolveAction(CartSetCustomerIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-deletedaysafterlastmodification-beta
     * @param CartSetDeleteDaysAfterLastModificationAction|callable $action
     * @return $this
     */
    public function setDeleteDaysAfterLastModification($action = null)
    {
        $this->addAction($this->resolveAction(CartSetDeleteDaysAfterLastModificationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-customfield
     * @param CartSetLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
     * @param CartSetLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
     * @param CartSetLineItemPriceAction|callable $action
     * @return $this
     */
    public function setLineItemPrice($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemPriceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
     * @param CartSetLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-taxamount
     * @param CartSetLineItemTaxAmountAction|callable $action
     * @return $this
     */
    public function setLineItemTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemTaxAmountAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-taxrate
     * @param CartSetLineItemTaxRateAction|callable $action
     * @return $this
     */
    public function setLineItemTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemTaxRateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
     * @param CartSetLineItemTotalPriceAction|callable $action
     * @return $this
     */
    public function setLineItemTotalPrice($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLineItemTotalPriceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-locale
     * @param CartSetLocaleAction|callable $action
     * @return $this
     */
    public function setLocale($action = null)
    {
        $this->addAction($this->resolveAction(CartSetLocaleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shipping-address
     * @param CartSetShippingAddressAction|callable $action
     * @return $this
     */
    public function setShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetShippingAddressCustomField|callable $action
     * @return $this
     */
    public function setShippingAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingAddressCustomField::class, $action));
        return $this;
    }

    /**
     *
     * @param CartSetShippingAddressCustomType|callable $action
     * @return $this
     */
    public function setShippingAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingAddressCustomType::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod
     * @param CartSetShippingMethodAction|callable $action
     * @return $this
     */
    public function setShippingMethod($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingMethodAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod-taxamount
     * @param CartSetShippingMethodTaxAmountAction|callable $action
     * @return $this
     */
    public function setShippingMethodTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingMethodTaxAmountAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod-taxrate
     * @param CartSetShippingMethodTaxRateAction|callable $action
     * @return $this
     */
    public function setShippingMethodTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingMethodTaxRateAction::class, $action));
        return $this;
    }

    /**
     * @link https://dev.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
     * @param CartSetShippingRateInputAction|callable $action
     * @return $this
     */
    public function setShippingRateInput($action = null)
    {
        $this->addAction($this->resolveAction(CartSetShippingRateInputAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#update-itemshippingaddress
     * @param CartUpdateItemShippingAddressAction|callable $action
     * @return $this
     */
    public function updateItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(CartUpdateItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @return CartsActionBuilder
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
