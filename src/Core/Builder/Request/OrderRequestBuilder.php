<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderImportRequest;
use Commercetools\Core\Request\Orders\OrderQueryRequest;
use Commercetools\Core\Request\Orders\OrderUpdateByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;

class OrderRequestBuilder
{
    /**
     * @return OrderQueryRequest
     */
    public function query()
    {
        return OrderQueryRequest::of();
    }

    /**
     * @param Order $order
     * @return OrderUpdateRequest
     */
    public function update(Order $order)
    {
        return OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion());
    }

    /**
     * @param Order $order
     * @return OrderUpdateByOrderNumberRequest
     */
    public function updateByOrderNumber(Order $order)
    {
        return OrderUpdateByOrderNumberRequest::ofOrderNumberAndVersion($order->getOrderNumber(), $order->getVersion());
    }

    /**
     * @param Cart $cart
     * @return OrderCreateFromCartRequest
     */
    public function createFromCart(Cart $cart)
    {
        return OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
    }

    /**
     * @param Order $order
     * @return OrderDeleteRequest
     */
    public function delete(Order $order)
    {
        return OrderDeleteRequest::ofIdAndVersion($order->getId(), $order->getVersion());
    }

    /**
     * @param Order $order
     * @return OrderDeleteByOrderNumberRequest
     */
    public function deleteByOrderNumber(Order $order)
    {
        return OrderDeleteByOrderNumberRequest::ofOrderNumberAndVersion($order->getOrderNumber(), $order->getVersion());
    }

    /**
     * @param string $id
     * @return OrderByIdGetRequest
     */
    public function getById($id)
    {
        return OrderByIdGetRequest::ofId($id);
    }

    /**
     * @param $orderNumber
     * @return OrderByOrderNumberGetRequest
     */
    public function getByOrderNumber($orderNumber)
    {
        return OrderByOrderNumberGetRequest::ofOrderNumber($orderNumber);
    }

    /**
     * @param ImportOrder $importOrder
     * @return OrderImportRequest
     */
    public function import(ImportOrder $importOrder)
    {
        return OrderImportRequest::ofImportOrder($importOrder);
    }
}
