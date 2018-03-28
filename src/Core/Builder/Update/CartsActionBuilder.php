<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartAddPaymentAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartSetDeleteDaysAfterLastModificationAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartRemoveDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerEmailAction;
use Commercetools\Core\Request\Carts\Command\CartSetLocaleAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartAddCustomLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxModeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemTotalPriceAction;
use Commercetools\Core\Request\Carts\Command\CartSetCartTotalTaxAction;
use Commercetools\Core\Request\Carts\Command\CartChangeLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartRecalculateAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerGroupAction;
use Commercetools\Core\Request\Carts\Command\CartSetBillingAddressAction;
use Commercetools\Core\Request\Carts\Command\CartSetAnonymousIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodAction;
use Commercetools\Core\Request\Carts\Command\CartSetLineItemCustomTypeAction;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomerIdAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartAddShoppingListAction;
use Commercetools\Core\Request\Carts\Command\CartAddDiscountCodeAction;
use Commercetools\Core\Request\Carts\Command\CartChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingRateInputAction;
use Commercetools\Core\Request\Carts\Command\CartSetCountryAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxRoundingModeAction;
use Commercetools\Core\Request\Carts\Command\CartRemovePaymentAction;
use Commercetools\Core\Request\Carts\Command\CartSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\Carts\Command\CartChangeTaxCalculationModeAction;
use Commercetools\Core\Request\Carts\Command\CartSetCustomLineItemCustomTypeAction;

class CartsActionBuilder
{
    /**
     * @return CartSetLineItemCustomFieldAction
     */
    public function setLineItemCustomField()
    {
        return CartSetLineItemCustomFieldAction::of();
    }

    /**
     * @return CartAddPaymentAction
     */
    public function addPayment()
    {
        return CartAddPaymentAction::of();
    }

    /**
     * @return CartRemoveLineItemAction
     */
    public function removeLineItem()
    {
        return CartRemoveLineItemAction::of();
    }

    /**
     * @return CartRemoveCustomLineItemAction
     */
    public function removeCustomLineItem()
    {
        return CartRemoveCustomLineItemAction::of();
    }

    /**
     * @return CartSetDeleteDaysAfterLastModificationAction
     */
    public function setDeleteDaysAfterLastModification()
    {
        return CartSetDeleteDaysAfterLastModificationAction::of();
    }

    /**
     * @return CartSetLineItemPriceAction
     */
    public function setLineItemPrice()
    {
        return CartSetLineItemPriceAction::of();
    }

    /**
     * @return CartSetLineItemTaxAmountAction
     */
    public function setLineItemTaxAmount()
    {
        return CartSetLineItemTaxAmountAction::of();
    }

    /**
     * @return CartRemoveDiscountCodeAction
     */
    public function removeDiscountCode()
    {
        return CartRemoveDiscountCodeAction::of();
    }

    /**
     * @return CartSetShippingAddressAction
     */
    public function setShippingAddress()
    {
        return CartSetShippingAddressAction::of();
    }

    /**
     * @return CartChangeCustomLineItemMoneyAction
     */
    public function changeCustomLineItemMoney()
    {
        return CartChangeCustomLineItemMoneyAction::of();
    }

    /**
     * @return CartSetCustomerEmailAction
     */
    public function setCustomerEmail()
    {
        return CartSetCustomerEmailAction::of();
    }

    /**
     * @return CartSetLocaleAction
     */
    public function setLocale()
    {
        return CartSetLocaleAction::of();
    }

    /**
     * @return CartSetCustomShippingMethodAction
     */
    public function setCustomShippingMethod()
    {
        return CartSetCustomShippingMethodAction::of();
    }

    /**
     * @return CartSetCustomLineItemCustomFieldAction
     */
    public function setCustomLineItemCustomField()
    {
        return CartSetCustomLineItemCustomFieldAction::of();
    }

    /**
     * @return CartSetLineItemTaxRateAction
     */
    public function setLineItemTaxRate()
    {
        return CartSetLineItemTaxRateAction::of();
    }

    /**
     * @return CartSetShippingMethodTaxRateAction
     */
    public function setShippingMethodTaxRate()
    {
        return CartSetShippingMethodTaxRateAction::of();
    }

    /**
     * @return CartAddCustomLineItemAction
     */
    public function addCustomLineItem()
    {
        return CartAddCustomLineItemAction::of();
    }

    /**
     * @return CartChangeTaxModeAction
     */
    public function changeTaxMode()
    {
        return CartChangeTaxModeAction::of();
    }

    /**
     * @return CartSetCustomLineItemTaxRateAction
     */
    public function setCustomLineItemTaxRate()
    {
        return CartSetCustomLineItemTaxRateAction::of();
    }

    /**
     * @return CartSetLineItemTotalPriceAction
     */
    public function setLineItemTotalPrice()
    {
        return CartSetLineItemTotalPriceAction::of();
    }

    /**
     * @return CartSetCartTotalTaxAction
     */
    public function setCartTotalTax()
    {
        return CartSetCartTotalTaxAction::of();
    }

    /**
     * @return CartChangeLineItemQuantityAction
     */
    public function changeLineItemQuantity()
    {
        return CartChangeLineItemQuantityAction::of();
    }

    /**
     * @return CartRecalculateAction
     */
    public function recalculate()
    {
        return CartRecalculateAction::of();
    }

    /**
     * @return CartSetCustomerGroupAction
     */
    public function setCustomerGroup()
    {
        return CartSetCustomerGroupAction::of();
    }

    /**
     * @return CartSetBillingAddressAction
     */
    public function setBillingAddress()
    {
        return CartSetBillingAddressAction::of();
    }

    /**
     * @return CartSetAnonymousIdAction
     */
    public function setAnonymousId()
    {
        return CartSetAnonymousIdAction::of();
    }

    /**
     * @return CartSetShippingMethodAction
     */
    public function setShippingMethod()
    {
        return CartSetShippingMethodAction::of();
    }

    /**
     * @return CartSetLineItemCustomTypeAction
     */
    public function setLineItemCustomType()
    {
        return CartSetLineItemCustomTypeAction::of();
    }

    /**
     * @return CartAddLineItemAction
     */
    public function addLineItem()
    {
        return CartAddLineItemAction::of();
    }

    /**
     * @return CartSetCustomerIdAction
     */
    public function setCustomerId()
    {
        return CartSetCustomerIdAction::of();
    }

    /**
     * @return CartSetCustomLineItemTaxAmountAction
     */
    public function setCustomLineItemTaxAmount()
    {
        return CartSetCustomLineItemTaxAmountAction::of();
    }

    /**
     * @return CartAddShoppingListAction
     */
    public function addShoppingList()
    {
        return CartAddShoppingListAction::of();
    }

    /**
     * @return CartAddDiscountCodeAction
     */
    public function addDiscountCode()
    {
        return CartAddDiscountCodeAction::of();
    }

    /**
     * @return CartChangeCustomLineItemQuantityAction
     */
    public function changeCustomLineItemQuantity()
    {
        return CartChangeCustomLineItemQuantityAction::of();
    }

    /**
     * @return CartSetShippingRateInputAction
     */
    public function setShippingRateInput()
    {
        return CartSetShippingRateInputAction::of();
    }

    /**
     * @return CartSetCountryAction
     */
    public function setCountry()
    {
        return CartSetCountryAction::of();
    }

    /**
     * @return CartChangeTaxRoundingModeAction
     */
    public function changeTaxRoundingMode()
    {
        return CartChangeTaxRoundingModeAction::of();
    }

    /**
     * @return CartRemovePaymentAction
     */
    public function removePayment()
    {
        return CartRemovePaymentAction::of();
    }

    /**
     * @return CartSetShippingMethodTaxAmountAction
     */
    public function setShippingMethodTaxAmount()
    {
        return CartSetShippingMethodTaxAmountAction::of();
    }

    /**
     * @return CartChangeTaxCalculationModeAction
     */
    public function changeTaxCalculationMode()
    {
        return CartChangeTaxCalculationModeAction::of();
    }

    /**
     * @return CartSetCustomLineItemCustomTypeAction
     */
    public function setCustomLineItemCustomType()
    {
        return CartSetCustomLineItemCustomTypeAction::of();
    }
}
