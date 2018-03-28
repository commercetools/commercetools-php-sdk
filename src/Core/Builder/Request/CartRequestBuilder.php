<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;

class CartRequestBuilder
{
    /**
     * @return CartQueryRequest
     */
    public function query()
    {
        return CartQueryRequest::of();
    }

    /**
     * @param Cart $cart
     * @return CartUpdateRequest
     */
    public function update(Cart $cart)
    {
        return CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
    }

    /**
     * @param CartDraft $cartDraft
     * @return CartCreateRequest
     */
    public function create(CartDraft $cartDraft)
    {
        return CartCreateRequest::ofDraft($cartDraft);
    }

    /**
     * @param Cart $cart
     * @return CartDeleteRequest
     */
    public function delete(Cart $cart)
    {
        return CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
    }

    /**
     * @param string $id
     * @return CartByIdGetRequest
     */
    public function getById($id)
    {
        return CartByIdGetRequest::ofId($id);
    }

    /**
     * @param string $customerId
     * @return CartByCustomerIdGetRequest
     */
    public function getByCustomerId($customerId)
    {
        return CartByCustomerIdGetRequest::ofCustomerId($customerId);
    }
}
