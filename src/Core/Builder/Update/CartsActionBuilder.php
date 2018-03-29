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
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-customfield
     * @param array $data
     * @return CartSetLineItemCustomFieldAction
     */
    public function setLineItemCustomField(array $data = [])
    {
        return new CartSetLineItemCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-payment
     * @param array $data
     * @return CartAddPaymentAction
     */
    public function addPayment(array $data = [])
    {
        return new CartAddPaymentAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-lineitem
     * @param array $data
     * @return CartRemoveLineItemAction
     */
    public function removeLineItem(array $data = [])
    {
        return new CartRemoveLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-customlineitem
     * @param array $data
     * @return CartRemoveCustomLineItemAction
     */
    public function removeCustomLineItem(array $data = [])
    {
        return new CartRemoveCustomLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-deletedaysafterlastmodification-beta
     * @param array $data
     * @return CartSetDeleteDaysAfterLastModificationAction
     */
    public function setDeleteDaysAfterLastModification(array $data = [])
    {
        return new CartSetDeleteDaysAfterLastModificationAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
     * @param array $data
     * @return CartSetLineItemPriceAction
     */
    public function setLineItemPrice(array $data = [])
    {
        return new CartSetLineItemPriceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-taxamount
     * @param array $data
     * @return CartSetLineItemTaxAmountAction
     */
    public function setLineItemTaxAmount(array $data = [])
    {
        return new CartSetLineItemTaxAmountAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-discountcode
     * @param array $data
     * @return CartRemoveDiscountCodeAction
     */
    public function removeDiscountCode(array $data = [])
    {
        return new CartRemoveDiscountCodeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shipping-address
     * @param array $data
     * @return CartSetShippingAddressAction
     */
    public function setShippingAddress(array $data = [])
    {
        return new CartSetShippingAddressAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-customlineitem-money
     * @param array $data
     * @return CartChangeCustomLineItemMoneyAction
     */
    public function changeCustomLineItemMoney(array $data = [])
    {
        return new CartChangeCustomLineItemMoneyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-email
     * @param array $data
     * @return CartSetCustomerEmailAction
     */
    public function setCustomerEmail(array $data = [])
    {
        return new CartSetCustomerEmailAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-locale
     * @param array $data
     * @return CartSetLocaleAction
     */
    public function setLocale(array $data = [])
    {
        return new CartSetLocaleAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-custom-shippingmethod
     * @param array $data
     * @return CartSetCustomShippingMethodAction
     */
    public function setCustomShippingMethod(array $data = [])
    {
        return new CartSetCustomShippingMethodAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-customfield
     * @param array $data
     * @return CartSetCustomLineItemCustomFieldAction
     */
    public function setCustomLineItemCustomField(array $data = [])
    {
        return new CartSetCustomLineItemCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-taxrate
     * @param array $data
     * @return CartSetLineItemTaxRateAction
     */
    public function setLineItemTaxRate(array $data = [])
    {
        return new CartSetLineItemTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod-taxrate
     * @param array $data
     * @return CartSetShippingMethodTaxRateAction
     */
    public function setShippingMethodTaxRate(array $data = [])
    {
        return new CartSetShippingMethodTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-customlineitem
     * @param array $data
     * @return CartAddCustomLineItemAction
     */
    public function addCustomLineItem(array $data = [])
    {
        return new CartAddCustomLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-taxmode
     * @param array $data
     * @return CartChangeTaxModeAction
     */
    public function changeTaxMode(array $data = [])
    {
        return new CartChangeTaxModeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxrate
     * @param array $data
     * @return CartSetCustomLineItemTaxRateAction
     */
    public function setCustomLineItemTaxRate(array $data = [])
    {
        return new CartSetCustomLineItemTaxRateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-lineitem-totalprice
     * @param array $data
     * @return CartSetLineItemTotalPriceAction
     */
    public function setLineItemTotalPrice(array $data = [])
    {
        return new CartSetLineItemTotalPriceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-cart-total-tax
     * @param array $data
     * @return CartSetCartTotalTaxAction
     */
    public function setCartTotalTax(array $data = [])
    {
        return new CartSetCartTotalTaxAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-lineitem-quantity
     * @param array $data
     * @return CartChangeLineItemQuantityAction
     */
    public function changeLineItemQuantity(array $data = [])
    {
        return new CartChangeLineItemQuantityAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#recalculate
     * @param array $data
     * @return CartRecalculateAction
     */
    public function recalculate(array $data = [])
    {
        return new CartRecalculateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-group
     * @param array $data
     * @return CartSetCustomerGroupAction
     */
    public function setCustomerGroup(array $data = [])
    {
        return new CartSetCustomerGroupAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-billing-address
     * @param array $data
     * @return CartSetBillingAddressAction
     */
    public function setBillingAddress(array $data = [])
    {
        return new CartSetBillingAddressAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-anonymous-id
     * @param array $data
     * @return CartSetAnonymousIdAction
     */
    public function setAnonymousId(array $data = [])
    {
        return new CartSetAnonymousIdAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod
     * @param array $data
     * @return CartSetShippingMethodAction
     */
    public function setShippingMethod(array $data = [])
    {
        return new CartSetShippingMethodAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
     * @param array $data
     * @return CartSetLineItemCustomTypeAction
     */
    public function setLineItemCustomType(array $data = [])
    {
        return new CartSetLineItemCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-lineitem
     * @param array $data
     * @return CartAddLineItemAction
     */
    public function addLineItem(array $data = [])
    {
        return new CartAddLineItemAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customer-id
     * @param array $data
     * @return CartSetCustomerIdAction
     */
    public function setCustomerId(array $data = [])
    {
        return new CartSetCustomerIdAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-taxamount
     * @param array $data
     * @return CartSetCustomLineItemTaxAmountAction
     */
    public function setCustomLineItemTaxAmount(array $data = [])
    {
        return new CartSetCustomLineItemTaxAmountAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-shoppinglist
     * @param array $data
     * @return CartAddShoppingListAction
     */
    public function addShoppingList(array $data = [])
    {
        return new CartAddShoppingListAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#add-discountcode
     * @param array $data
     * @return CartAddDiscountCodeAction
     */
    public function addDiscountCode(array $data = [])
    {
        return new CartAddDiscountCodeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-customlineitem-quantity
     * @param array $data
     * @return CartChangeCustomLineItemQuantityAction
     */
    public function changeCustomLineItemQuantity(array $data = [])
    {
        return new CartChangeCustomLineItemQuantityAction($data);
    }

    /**
     * @link https://dev.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
     * @param array $data
     * @return CartSetShippingRateInputAction
     */
    public function setShippingRateInput(array $data = [])
    {
        return new CartSetShippingRateInputAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-country
     * @param array $data
     * @return CartSetCountryAction
     */
    public function setCountry(array $data = [])
    {
        return new CartSetCountryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-tax-roundingmode
     * @param array $data
     * @return CartChangeTaxRoundingModeAction
     */
    public function changeTaxRoundingMode(array $data = [])
    {
        return new CartChangeTaxRoundingModeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-payment
     * @param array $data
     * @return CartRemovePaymentAction
     */
    public function removePayment(array $data = [])
    {
        return new CartRemovePaymentAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod-taxamount
     * @param array $data
     * @return CartSetShippingMethodTaxAmountAction
     */
    public function setShippingMethodTaxAmount(array $data = [])
    {
        return new CartSetShippingMethodTaxAmountAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#change-tax-calculationmode
     * @param array $data
     * @return CartChangeTaxCalculationModeAction
     */
    public function changeTaxCalculationMode(array $data = [])
    {
        return new CartChangeTaxCalculationModeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#set-customlineitem-custom-type
     * @param array $data
     * @return CartSetCustomLineItemCustomTypeAction
     */
    public function setCustomLineItemCustomType(array $data = [])
    {
        return new CartSetCustomLineItemCustomTypeAction($data);
    }

    /**
     * @return CartsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
