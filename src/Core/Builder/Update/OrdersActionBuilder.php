<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Orders\Command\OrderTransitionStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;
use Commercetools\Core\Request\Orders\Command\OrderAddPaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderRemovePaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveParcelFromDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelTrackingDataAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelMeasurementsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomerEmail;
use Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryItemsAction;
use Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetShippingAddress;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLocaleAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetBillingAddress;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelItemsAction;

class OrdersActionBuilder
{
    /**
     * @return OrderTransitionStateAction
     */
    public function transitionState()
    {
        return OrderTransitionStateAction::of();
    }

    /**
     * @return OrderSetOrderNumberAction
     */
    public function setOrderNumber()
    {
        return OrderSetOrderNumberAction::of();
    }

    /**
     * @return OrderAddPaymentAction
     */
    public function addPayment()
    {
        return OrderAddPaymentAction::of();
    }

    /**
     * @return OrderRemovePaymentAction
     */
    public function removePayment()
    {
        return OrderRemovePaymentAction::of();
    }

    /**
     * @return OrderSetReturnShipmentStateAction
     */
    public function setReturnShipmentState()
    {
        return OrderSetReturnShipmentStateAction::of();
    }

    /**
     * @return OrderImportCustomLineItemStateAction
     */
    public function importCustomLineItemState()
    {
        return OrderImportCustomLineItemStateAction::of();
    }

    /**
     * @return OrderAddReturnInfoAction
     */
    public function addReturnInfo()
    {
        return OrderAddReturnInfoAction::of();
    }

    /**
     * @return OrderRemoveParcelFromDeliveryAction
     */
    public function removeParcelFromDelivery()
    {
        return OrderRemoveParcelFromDeliveryAction::of();
    }

    /**
     * @return OrderSetReturnPaymentStateAction
     */
    public function setReturnPaymentState()
    {
        return OrderSetReturnPaymentStateAction::of();
    }

    /**
     * @return OrderRemoveDeliveryAction
     */
    public function removeDelivery()
    {
        return OrderRemoveDeliveryAction::of();
    }

    /**
     * @return OrderSetParcelTrackingDataAction
     */
    public function setParcelTrackingData()
    {
        return OrderSetParcelTrackingDataAction::of();
    }

    /**
     * @return OrderSetParcelMeasurementsAction
     */
    public function setParcelMeasurements()
    {
        return OrderSetParcelMeasurementsAction::of();
    }

    /**
     * @return OrderSetCustomerEmail
     */
    public function setCustomerEmail()
    {
        return OrderSetCustomerEmail::of();
    }

    /**
     * @return OrderTransitionCustomLineItemStateAction
     */
    public function transitionCustomLineItemState()
    {
        return OrderTransitionCustomLineItemStateAction::of();
    }

    /**
     * @return OrderSetDeliveryItemsAction
     */
    public function setDeliveryItems()
    {
        return OrderSetDeliveryItemsAction::of();
    }

    /**
     * @return OrderImportLineItemStateAction
     */
    public function importLineItemState()
    {
        return OrderImportLineItemStateAction::of();
    }

    /**
     * @return OrderAddParcelToDeliveryAction
     */
    public function addParcelToDelivery()
    {
        return OrderAddParcelToDeliveryAction::of();
    }

    /**
     * @return OrderChangeOrderStateAction
     */
    public function changeOrderState()
    {
        return OrderChangeOrderStateAction::of();
    }

    /**
     * @return OrderSetShippingAddress
     */
    public function setShippingAddress()
    {
        return OrderSetShippingAddress::of();
    }

    /**
     * @return OrderSetDeliveryAddressAction
     */
    public function setDeliveryAddress()
    {
        return OrderSetDeliveryAddressAction::of();
    }

    /**
     * @return OrderUpdateSyncInfoAction
     */
    public function updateSyncInfo()
    {
        return OrderUpdateSyncInfoAction::of();
    }

    /**
     * @return OrderTransitionLineItemStateAction
     */
    public function transitionLineItemState()
    {
        return OrderTransitionLineItemStateAction::of();
    }

    /**
     * @return OrderChangePaymentStateAction
     */
    public function changePaymentState()
    {
        return OrderChangePaymentStateAction::of();
    }

    /**
     * @return OrderAddDeliveryAction
     */
    public function addDelivery()
    {
        return OrderAddDeliveryAction::of();
    }

    /**
     * @return OrderSetLocaleAction
     */
    public function setLocale()
    {
        return OrderSetLocaleAction::of();
    }

    /**
     * @return OrderChangeShipmentStateAction
     */
    public function changeShipmentState()
    {
        return OrderChangeShipmentStateAction::of();
    }

    /**
     * @return OrderSetBillingAddress
     */
    public function setBillingAddress()
    {
        return OrderSetBillingAddress::of();
    }

    /**
     * @return OrderSetParcelItemsAction
     */
    public function setParcelItems()
    {
        return OrderSetParcelItemsAction::of();
    }
}
