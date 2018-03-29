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
     * @link https://docs.commercetools.com/http-api-projects-orders.html#transition-state
     * @param array $data
     * @return OrderTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return new OrderTransitionStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-order-number
     * @param array $data
     * @return OrderSetOrderNumberAction
     */
    public function setOrderNumber(array $data = [])
    {
        return new OrderSetOrderNumberAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-payment
     * @param array $data
     * @return OrderAddPaymentAction
     */
    public function addPayment(array $data = [])
    {
        return new OrderAddPaymentAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-payment
     * @param array $data
     * @return OrderRemovePaymentAction
     */
    public function removePayment(array $data = [])
    {
        return new OrderRemovePaymentAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-returnshipmentstate
     * @param array $data
     * @return OrderSetReturnShipmentStateAction
     */
    public function setReturnShipmentState(array $data = [])
    {
        return new OrderSetReturnShipmentStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#import-state-for-customlineitems
     * @param array $data
     * @return OrderImportCustomLineItemStateAction
     */
    public function importCustomLineItemState(array $data = [])
    {
        return new OrderImportCustomLineItemStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#addreturninfo
     * @param array $data
     * @return OrderAddReturnInfoAction
     */
    public function addReturnInfo(array $data = [])
    {
        return new OrderAddReturnInfoAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-parcel-from-delivery
     * @param array $data
     * @return OrderRemoveParcelFromDeliveryAction
     */
    public function removeParcelFromDelivery(array $data = [])
    {
        return new OrderRemoveParcelFromDeliveryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-returnpaymentstate
     * @param array $data
     * @return OrderSetReturnPaymentStateAction
     */
    public function setReturnPaymentState(array $data = [])
    {
        return new OrderSetReturnPaymentStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-delivery
     * @param array $data
     * @return OrderRemoveDeliveryAction
     */
    public function removeDelivery(array $data = [])
    {
        return new OrderRemoveDeliveryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-tracking-data
     * @param array $data
     * @return OrderSetParcelTrackingDataAction
     */
    public function setParcelTrackingData(array $data = [])
    {
        return new OrderSetParcelTrackingDataAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-measurements
     * @param array $data
     * @return OrderSetParcelMeasurementsAction
     */
    public function setParcelMeasurements(array $data = [])
    {
        return new OrderSetParcelMeasurementsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-customer-email
     * @param array $data
     * @return OrderSetCustomerEmail
     */
    public function setCustomerEmail(array $data = [])
    {
        return new OrderSetCustomerEmail($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-customlineitem-according-to-allowed-transitions
     * @param array $data
     * @return OrderTransitionCustomLineItemStateAction
     */
    public function transitionCustomLineItemState(array $data = [])
    {
        return new OrderTransitionCustomLineItemStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-items
     * @param array $data
     * @return OrderSetDeliveryItemsAction
     */
    public function setDeliveryItems(array $data = [])
    {
        return new OrderSetDeliveryItemsAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#import-state-for-lineitems
     * @param array $data
     * @return OrderImportLineItemStateAction
     */
    public function importLineItemState(array $data = [])
    {
        return new OrderImportLineItemStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-parcel
     * @param array $data
     * @return OrderAddParcelToDeliveryAction
     */
    public function addParcelToDelivery(array $data = [])
    {
        return new OrderAddParcelToDeliveryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-orderstate
     * @param array $data
     * @return OrderChangeOrderStateAction
     */
    public function changeOrderState(array $data = [])
    {
        return new OrderChangeOrderStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-shipping-address
     * @param array $data
     * @return OrderSetShippingAddress
     */
    public function setShippingAddress(array $data = [])
    {
        return new OrderSetShippingAddress($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-address
     * @param array $data
     * @return OrderSetDeliveryAddressAction
     */
    public function setDeliveryAddress(array $data = [])
    {
        return new OrderSetDeliveryAddressAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#update-syncinfo
     * @param array $data
     * @return OrderUpdateSyncInfoAction
     */
    public function updateSyncInfo(array $data = [])
    {
        return new OrderUpdateSyncInfoAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-lineitem-according-to-allowed-transitions
     * @param array $data
     * @return OrderTransitionLineItemStateAction
     */
    public function transitionLineItemState(array $data = [])
    {
        return new OrderTransitionLineItemStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-paymentstate
     * @param array $data
     * @return OrderChangePaymentStateAction
     */
    public function changePaymentState(array $data = [])
    {
        return new OrderChangePaymentStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-delivery
     * @param array $data
     * @return OrderAddDeliveryAction
     */
    public function addDelivery(array $data = [])
    {
        return new OrderAddDeliveryAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-locale
     * @param array $data
     * @return OrderSetLocaleAction
     */
    public function setLocale(array $data = [])
    {
        return new OrderSetLocaleAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-shipmentstate
     * @param array $data
     * @return OrderChangeShipmentStateAction
     */
    public function changeShipmentState(array $data = [])
    {
        return new OrderChangeShipmentStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-billing-address
     * @param array $data
     * @return OrderSetBillingAddress
     */
    public function setBillingAddress(array $data = [])
    {
        return new OrderSetBillingAddress($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-items
     * @param array $data
     * @return OrderSetParcelItemsAction
     */
    public function setParcelItems(array $data = [])
    {
        return new OrderSetParcelItemsAction($data);
    }

    /**
     * @return OrdersActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
