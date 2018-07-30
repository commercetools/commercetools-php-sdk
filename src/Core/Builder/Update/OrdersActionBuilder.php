<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddItemShippingAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddPaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderImportCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderImportLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveItemShippingAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveParcelFromDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderRemovePaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderSetBillingAddress;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomFieldAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemCustomFieldAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemCustomTypeAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomLineItemShippingDetailsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomTypeAction;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomerEmail;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryItemsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLineItemCustomFieldAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLineItemCustomTypeAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLineItemShippingDetailsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLocaleAction;
use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelItemsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelMeasurementsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelTrackingDataAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetShippingAddress;
use Commercetools\Core\Request\Orders\Command\OrderTransitionCustomLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderTransitionLineItemStateAction;
use Commercetools\Core\Request\Orders\Command\OrderTransitionStateAction;
use Commercetools\Core\Request\Orders\Command\OrderUpdateItemShippingAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction;

class OrdersActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-delivery
     * @param OrderAddDeliveryAction|callable $action
     * @return $this
     */
    public function addDelivery($action = null)
    {
        $this->addAction($this->resolveAction(OrderAddDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderAddItemShippingAddressAction|callable $action
     * @return $this
     */
    public function addItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderAddItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-parcel
     * @param OrderAddParcelToDeliveryAction|callable $action
     * @return $this
     */
    public function addParcelToDelivery($action = null)
    {
        $this->addAction($this->resolveAction(OrderAddParcelToDeliveryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#add-payment
     * @param OrderAddPaymentAction|callable $action
     * @return $this
     */
    public function addPayment($action = null)
    {
        $this->addAction($this->resolveAction(OrderAddPaymentAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#addreturninfo
     * @param OrderAddReturnInfoAction|callable $action
     * @return $this
     */
    public function addReturnInfo($action = null)
    {
        $this->addAction($this->resolveAction(OrderAddReturnInfoAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-orderstate
     * @param OrderChangeOrderStateAction|callable $action
     * @return $this
     */
    public function changeOrderState($action = null)
    {
        $this->addAction($this->resolveAction(OrderChangeOrderStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-paymentstate
     * @param OrderChangePaymentStateAction|callable $action
     * @return $this
     */
    public function changePaymentState($action = null)
    {
        $this->addAction($this->resolveAction(OrderChangePaymentStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-shipmentstate
     * @param OrderChangeShipmentStateAction|callable $action
     * @return $this
     */
    public function changeShipmentState($action = null)
    {
        $this->addAction($this->resolveAction(OrderChangeShipmentStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#import-state-for-customlineitems
     * @param OrderImportCustomLineItemStateAction|callable $action
     * @return $this
     */
    public function importCustomLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(OrderImportCustomLineItemStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#import-state-for-lineitems
     * @param OrderImportLineItemStateAction|callable $action
     * @return $this
     */
    public function importLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(OrderImportLineItemStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-delivery
     * @param OrderRemoveDeliveryAction|callable $action
     * @return $this
     */
    public function removeDelivery($action = null)
    {
        $this->addAction($this->resolveAction(OrderRemoveDeliveryAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderRemoveItemShippingAddressAction|callable $action
     * @return $this
     */
    public function removeItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderRemoveItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-parcel-from-delivery
     * @param OrderRemoveParcelFromDeliveryAction|callable $action
     * @return $this
     */
    public function removeParcelFromDelivery($action = null)
    {
        $this->addAction($this->resolveAction(OrderRemoveParcelFromDeliveryAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-payment
     * @param OrderRemovePaymentAction|callable $action
     * @return $this
     */
    public function removePayment($action = null)
    {
        $this->addAction($this->resolveAction(OrderRemovePaymentAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-billing-address
     * @param OrderSetBillingAddress|callable $action
     * @return $this
     */
    public function setBillingAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetBillingAddress::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetCustomLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetCustomLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetCustomLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setCustomLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-customer-email
     * @param OrderSetCustomerEmail|callable $action
     * @return $this
     */
    public function setCustomerEmail($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetCustomerEmail::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-address
     * @param OrderSetDeliveryAddressAction|callable $action
     * @return $this
     */
    public function setDeliveryAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetDeliveryAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-delivery-items
     * @param OrderSetDeliveryItemsAction|callable $action
     * @return $this
     */
    public function setDeliveryItems($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetDeliveryItemsAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetLineItemCustomFieldAction|callable $action
     * @return $this
     */
    public function setLineItemCustomField($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetLineItemCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetLineItemCustomTypeAction|callable $action
     * @return $this
     */
    public function setLineItemCustomType($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetLineItemCustomTypeAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderSetLineItemShippingDetailsAction|callable $action
     * @return $this
     */
    public function setLineItemShippingDetails($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetLineItemShippingDetailsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-locale
     * @param OrderSetLocaleAction|callable $action
     * @return $this
     */
    public function setLocale($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetLocaleAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-order-number
     * @param OrderSetOrderNumberAction|callable $action
     * @return $this
     */
    public function setOrderNumber($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetOrderNumberAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-items
     * @param OrderSetParcelItemsAction|callable $action
     * @return $this
     */
    public function setParcelItems($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetParcelItemsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-measurements
     * @param OrderSetParcelMeasurementsAction|callable $action
     * @return $this
     */
    public function setParcelMeasurements($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetParcelMeasurementsAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-parcel-tracking-data
     * @param OrderSetParcelTrackingDataAction|callable $action
     * @return $this
     */
    public function setParcelTrackingData($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetParcelTrackingDataAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-returnpaymentstate
     * @param OrderSetReturnPaymentStateAction|callable $action
     * @return $this
     */
    public function setReturnPaymentState($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetReturnPaymentStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-returnshipmentstate
     * @param OrderSetReturnShipmentStateAction|callable $action
     * @return $this
     */
    public function setReturnShipmentState($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetReturnShipmentStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#set-shipping-address
     * @param OrderSetShippingAddress|callable $action
     * @return $this
     */
    public function setShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderSetShippingAddress::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-customlineitem-according-to-allowed-transitions
     * @param OrderTransitionCustomLineItemStateAction|callable $action
     * @return $this
     */
    public function transitionCustomLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(OrderTransitionCustomLineItemStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#change-the-state-of-lineitem-according-to-allowed-transitions
     * @param OrderTransitionLineItemStateAction|callable $action
     * @return $this
     */
    public function transitionLineItemState($action = null)
    {
        $this->addAction($this->resolveAction(OrderTransitionLineItemStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#transition-state
     * @param OrderTransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(OrderTransitionStateAction::class, $action));
        return $this;
    }

    /**
     *
     * @param OrderUpdateItemShippingAddressAction|callable $action
     * @return $this
     */
    public function updateItemShippingAddress($action = null)
    {
        $this->addAction($this->resolveAction(OrderUpdateItemShippingAddressAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#update-syncinfo
     * @param OrderUpdateSyncInfoAction|callable $action
     * @return $this
     */
    public function updateSyncInfo($action = null)
    {
        $this->addAction($this->resolveAction(OrderUpdateSyncInfoAction::class, $action));
        return $this;
    }

    /**
     * @return OrdersActionBuilder
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
