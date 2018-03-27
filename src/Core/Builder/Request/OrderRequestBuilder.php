<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderQueryRequest;
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
     * @param $id
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
}
