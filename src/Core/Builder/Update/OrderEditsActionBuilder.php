<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditAddStagedActionAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCommentAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetKeyAction;
use Commercetools\Core\Request\OrderEdits\Command\OrderEditSetStagedActionsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddDeliveryAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddLineItemAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddPaymentAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddReturnInfoAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderAddShoppingListAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeCustomLineItemMoneyAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeCustomLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeLineItemQuantityAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeOrderStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangePaymentStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeShipmentStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeTaxCalculationModeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeTaxModeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderChangeTaxRoundingModeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderImportCustomLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderImportLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveCustomLineItemAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveDeliveryAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveDiscountCodeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveLineItemAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemoveParcelFromDeliveryAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderRemovePaymentAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetBillingAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCountryAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomerEmailAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomerGroupAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetCustomerIdAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetDeliveryAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetDeliveryItemsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemCustomFieldAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemCustomTypeAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemPriceAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemTaxRateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLineItemTotalPriceAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetLocaleAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetOrderNumberAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetOrderTotalTaxAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetParcelItemsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetParcelMeasurementsAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetParcelTrackingDataAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingAddressAndCustomShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingAddressAndShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingMethodAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingMethodTaxAmountAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingMethodTaxRateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderSetShippingRateInputAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderTransitionLineItemStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderTransitionStateAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderUpdateItemShippingAddressAction;
use Commercetools\Core\Request\OrderEdits\Command\StagedOrderUpdateSyncInfoAction;

class OrderEditsActionBuilder
{
    private $actions = [];

    /**
     *
     * @param OrderEditAddStagedActionAction|callable $action
     * @return $this
     */
    public function addStagedAction($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditAddStagedActionAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCommentAction|callable $action
     * @return $this
     */
    public function setComment($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCommentAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetKeyAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderEditSetStagedActionsAction|callable $action
     * @return $this
     */
    public function setStagedActions($action = null)
    {
        $this->addAction($this->resolveAction(OrderEditSetStagedActionsAction::class, $action));
        return $this;
    }

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
     * @param StagedOrderSetCountryAction|callable $action
     * @return $this
     */
    public function setCountry($action = null)
    {
        $this->addAction($this->resolveAction(StagedOrderSetCountryAction::class, $action));
        return $this;
    }

//    /**
//     *
//     * @param StagedOrderSetCustomFieldAction|callable $action
//     * @return $this
//     */
//    public function setCustomField($action = null)
//    {
//        $this->addAction($this->resolveAction(StagedOrderSetCustomFieldAction::class, $action));
//        return $this;
//    }

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

//    /**
//     *
//     * @param StagedOrderSetCustomTypeAction|callable $action
//     * @return $this
//     */
//    public function setCustomType($action = null)
//    {
//        $this->addAction($this->resolveAction(StagedOrderSetCustomTypeAction::class, $action));
//        return $this;
//    }

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
     * @return OrderEditsActionBuilder
     */
    public function of()
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
