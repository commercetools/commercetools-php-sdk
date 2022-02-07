<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddDeliveryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddPaymentAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddReturnInfoAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderAddShoppingListAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeOrderStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangePaymentStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeShipmentStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxCalculationModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderChangeTaxRoundingModeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderImportCustomLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderImportLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveDeliveryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveLineItemAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemoveParcelFromDeliveryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderRemovePaymentAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetBillingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetBillingAddressCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetBillingAddressCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCountryAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerEmailAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerGroupAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetCustomerIdAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetDeliveryAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetDeliveryAddressCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetDeliveryAddressCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetDeliveryItemsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetItemShippingAddressCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetItemShippingAddressCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemDistributionChannelAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemPriceAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLineItemTotalPriceAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetLocaleAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetOrderNumberAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetOrderTotalTaxAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetParcelCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetParcelCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetParcelItemsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetParcelMeasurementsAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetParcelTrackingDataAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetReturnInfoAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetReturnItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetReturnItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAction;
// phpcs:ignore
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAndCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressAndShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingAddressCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingMethodTaxRateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderSetShippingRateInputAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderTransitionLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderTransitionStateAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateSyncInfoAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;

class StagedOrderActionBuilder
{
    private $actions = [];

    /**
     *
     * @param StagedOrderAddCustomLineItemAction|callable $action
     * @return $this
     */
    public function addCustomLineItem($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddCustomLineItemAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddDeliveryAction|callable $action
     * @return $this
     */
    public function addDelivery($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddDiscountCodeAction|callable $action
     * @return $this
     */
    public function addDiscountCode($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddDiscountCodeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddItemShippingAddressAction|callable $action
     * @return $this
     */
    public function addItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddLineItemAction|callable $action
     * @return $this
     */
    public function addLineItem($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddLineItemAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddParcelToDeliveryAction|callable $action
     * @return $this
     */
    public function addParcelToDelivery($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddParcelToDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddPaymentAction|callable $action
     * @return $this
     */
    public function addPayment($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddPaymentAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddReturnInfoAction|callable $action
     * @return $this
     */
    public function addReturnInfo($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddReturnInfoAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderAddShoppingListAction|callable $action
     * @return $this
     */
    public function addShoppingList($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderAddShoppingListAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeCustomLineItemMoneyAction|callable $action
     * @return $this
     */
    public function changeCustomLineItemMoney($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeCustomLineItemMoneyAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeCustomLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeCustomLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeCustomLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeLineItemQuantityAction|callable $action
     * @return $this
     */
    public function changeLineItemQuantity($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeLineItemQuantityAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeOrderStateAction|callable $action
     * @return $this
     */
    public function changeOrderState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeOrderStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangePaymentStateAction|callable $action
     * @return $this
     */
    public function changePaymentState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangePaymentStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeShipmentStateAction|callable $action
     * @return $this
     */
    public function changeShipmentState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeShipmentStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeTaxCalculationModeAction|callable $action
     * @return $this
     */
    public function changeTaxCalculationMode($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeTaxCalculationModeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeTaxModeAction|callable $action
     * @return $this
     */
    public function changeTaxMode($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeTaxModeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderChangeTaxRoundingModeAction|callable $action
     * @return $this
     */
    public function changeTaxRoundingMode($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderChangeTaxRoundingModeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderImportCustomLineItemStateAction|callable $action
     * @return $this
     */
    public function importCustomLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderImportCustomLineItemStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderImportLineItemStateAction|callable $action
     * @return $this
     */
    public function importLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderImportLineItemStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveCustomLineItemAction|callable $action
     * @return $this
     */
    public function removeCustomLineItem($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveCustomLineItemAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveDeliveryAction|callable $action
     * @return $this
     */
    public function removeDelivery($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveDiscountCodeAction|callable $action
     * @return $this
     */
    public function removeDiscountCode($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveDiscountCodeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveItemShippingAddressAction|callable $action
     * @return $this
     */
    public function removeItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveLineItemAction|callable $action
     * @return $this
     */
    public function removeLineItem($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveLineItemAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemoveParcelFromDeliveryAction|callable $action
     * @return $this
     */
    public function removeParcelFromDelivery($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemoveParcelFromDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderRemovePaymentAction|callable $action
     * @return $this
     */
    public function removePayment($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderRemovePaymentAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetBillingAddressAction|callable $action
     * @return $this
     */
    public function setBillingAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetBillingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetBillingAddressCustomFieldAction|callable $action
     * @return $this
     */
    public function setBillingAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetBillingAddressCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetBillingAddressCustomTypeAction|callable $action
     * @return $this
     */
    public function setBillingAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetBillingAddressCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCountryAction|callable $action
     * @return $this
     */
    public function setCountry($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCountryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setCustomLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomLineItemTaxAmountAction|callable $action
     * @return $this
     */
    public function setCustomLineItemTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomLineItemTaxAmountAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomLineItemTaxRateAction|callable $action
     * @return $this
     */
    public function setCustomLineItemTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomLineItemTaxRateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomShippingMethodAction|callable $action
     * @return $this
     */
    public function setCustomShippingMethod($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomShippingMethodAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomerEmailAction|callable $action
     * @return $this
     */
    public function setCustomerEmail($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomerEmailAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomerGroupAction|callable $action
     * @return $this
     */
    public function setCustomerGroup($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomerGroupAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetCustomerIdAction|callable $action
     * @return $this
     */
    public function setCustomerId($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCustomerIdAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetDeliveryAddressAction|callable $action
     * @return $this
     */
    public function setDeliveryAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetDeliveryAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetDeliveryAddressCustomFieldAction|callable $action
     * @return $this
     */
    public function setDeliveryAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetDeliveryAddressCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetDeliveryAddressCustomTypeAction|callable $action
     * @return $this
     */
    public function setDeliveryAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetDeliveryAddressCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetDeliveryItemsAction|callable $action
     * @return $this
     */
    public function setDeliveryItems($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetDeliveryItemsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetItemShippingAddressCustomFieldAction|callable $action
     * @return $this
     */
    public function setItemShippingAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetItemShippingAddressCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetItemShippingAddressCustomTypeAction|callable $action
     * @return $this
     */
    public function setItemShippingAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetItemShippingAddressCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemDistributionChannelAction|callable $action
     * @return $this
     */
    public function setLineItemDistributionChannel($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemDistributionChannelAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemPriceAction|callable $action
     * @return $this
     */
    public function setLineItemPrice($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemPriceAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemTaxAmountAction|callable $action
     * @return $this
     */
    public function setLineItemTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemTaxAmountAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemTaxRateAction|callable $action
     * @return $this
     */
    public function setLineItemTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemTaxRateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLineItemTotalPriceAction|callable $action
     * @return $this
     */
    public function setLineItemTotalPrice($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLineItemTotalPriceAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetLocaleAction|callable $action
     * @return $this
     */
    public function setLocale($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetLocaleAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetOrderNumberAction|callable $action
     * @return $this
     */
    public function setOrderNumber($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetOrderNumberAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetOrderTotalTaxAction|callable $action
     * @return $this
     */
    public function setOrderTotalTax($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetOrderTotalTaxAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetParcelCustomFieldAction|callable $action
     * @return $this
     */
    public function setParcelCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetParcelCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetParcelCustomTypeAction|callable $action
     * @return $this
     */
    public function setParcelCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetParcelCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetParcelItemsAction|callable $action
     * @return $this
     */
    public function setParcelItems($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetParcelItemsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetParcelMeasurementsAction|callable $action
     * @return $this
     */
    public function setParcelMeasurements($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetParcelMeasurementsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetParcelTrackingDataAction|callable $action
     * @return $this
     */
    public function setParcelTrackingData($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetParcelTrackingDataAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetReturnInfoAction|callable $action
     * @return $this
     */
    public function setReturnInfo($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetReturnInfoAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetReturnItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setReturnItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetReturnItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetReturnItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setReturnItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetReturnItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetReturnPaymentStateAction|callable $action
     * @return $this
     */
    public function setReturnPaymentState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetReturnPaymentStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetReturnShipmentStateAction|callable $action
     * @return $this
     */
    public function setReturnShipmentState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetReturnShipmentStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingAddressAction|callable $action
     * @return $this
     */
    public function setShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingAddressAndCustomShippingMethodAction|callable $action
     * @return $this
     */
    public function setShippingAddressAndCustomShippingMethod($action = null)
    {
        // phpcs:ignore
        $this->addAction($this->resolveAction(StagedOrderSetShippingAddressAndCustomShippingMethodAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingAddressAndShippingMethodAction|callable $action
     * @return $this
     */
    public function setShippingAddressAndShippingMethod($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingAddressAndShippingMethodAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingAddressCustomFieldAction|callable $action
     * @return $this
     */
    public function setShippingAddressCustomField($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingAddressCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingAddressCustomTypeAction|callable $action
     * @return $this
     */
    public function setShippingAddressCustomType($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingAddressCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingMethodAction|callable $action
     * @return $this
     */
    public function setShippingMethod($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingMethodAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingMethodTaxAmountAction|callable $action
     * @return $this
     */
    public function setShippingMethodTaxAmount($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingMethodTaxAmountAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingMethodTaxRateAction|callable $action
     * @return $this
     */
    public function setShippingMethodTaxRate($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingMethodTaxRateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderSetShippingRateInputAction|callable $action
     * @return $this
     */
    public function setShippingRateInput($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetShippingRateInputAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderTransitionCustomLineItemStateAction|callable $action
     * @return $this
     */
    public function transitionCustomLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderTransitionCustomLineItemStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderTransitionLineItemStateAction|callable $action
     * @return $this
     */
    public function transitionLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderTransitionLineItemStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderTransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderTransitionStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderUpdateItemShippingAddressAction|callable $action
     * @return $this
     */
    public function updateItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderUpdateItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     *
     * @param StagedOrderUpdateSyncInfoAction|callable $action
     * @return $this
     */
    public function updateSyncInfo($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderUpdateSyncInfoAction::class, $action));
        return $this;
    }

    /**
     * @return StagedOrderActionBuilder
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
     * @return StagedOrderUpdateActionCollection
     */
    public function getActionsCollection()
    {
        return StagedOrderUpdateActionCollection::fromArray($this->actions);
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
