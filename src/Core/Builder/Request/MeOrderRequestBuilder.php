<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Request\Me\MeOrderByIdRequest;
use Commercetools\Core\Request\Me\MeOrderCreateFromCartRequest;
use Commercetools\Core\Request\Me\MeOrderQueryRequest;

class MeOrderRequestBuilder
{
    /**
     * @return MeOrderQueryRequest
     */
    public function query()
    {
        return MeOrderQueryRequest::of();
    }

    /**
     * @param string $orderId
     * @return MeOrderByIdRequest
     */
    public function getById($orderId)
    {
        return MeOrderByIdRequest::ofId($orderId);
    }

    /**
     * @param Cart $cart
     * @return MeOrderCreateFromCartRequest
     */
    public function createFromCart(Cart $cart)
    {
        return MeOrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
    }
}
