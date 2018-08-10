<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Request\Orders\OrderDeleteByOrderNumberRequest;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderImportRequest;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Request\Orders\OrderQueryRequest;
use Commercetools\Core\Request\Orders\OrderUpdateByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;

class OrderRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#get-order-by-id
     * @param string $id
     * @return OrderByIdGetRequest
     */
    public function getById($id)
    {
        $request = OrderByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#get-order-by-ordernumber
     * @param string $orderNumber
     * @return OrderByOrderNumberGetRequest
     */
    public function getByOrderNumber($orderNumber)
    {
        $request = OrderByOrderNumberGetRequest::ofOrderNumber($orderNumber);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#create-order-from-cart
     * @param Cart $cart
     * @return OrderCreateFromCartRequest
     */
    public function createFromCart(Cart $cart)
    {
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#delete-order-by-ordernumber
     * @param Order $order
     * @return OrderDeleteByOrderNumberRequest
     */
    public function deleteByOrderNumber(Order $order)
    {
        $request = OrderDeleteByOrderNumberRequest::ofOrderNumberAndVersion($order->getOrderNumber(), $order->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#delete-order
     * @param Order $order
     * @return OrderDeleteRequest
     */
    public function delete(Order $order)
    {
        $request = OrderDeleteRequest::ofIdAndVersion($order->getId(), $order->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders-import.html#create-an-order-by-import
     * @param ImportOrder $importOrder
     * @return OrderImportRequest
     */
    public function import(ImportOrder $importOrder)
    {
        $request = OrderImportRequest::ofImportOrder($importOrder);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#query-orders
     * @param 
     * @return OrderQueryRequest
     */
    public function query()
    {
        $request = OrderQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#update-order-by-ordernumber
     * @param Order $order
     * @return OrderUpdateByOrderNumberRequest
     */
    public function updateByOrderNumber(Order $order)
    {
        $request = OrderUpdateByOrderNumberRequest::ofOrderNumberAndVersion($order->getOrderNumber(), $order->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-orders.html#update-order
     * @param Order $order
     * @return OrderUpdateRequest
     */
    public function update(Order $order)
    {
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion());
        return $request;
    }

    /**
     * @return OrderRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
