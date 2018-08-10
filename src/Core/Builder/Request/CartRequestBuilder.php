<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartReplicateRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;

class CartRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#get-cart-by-customer-id
     * @param string $customerId
     * @return CartByCustomerIdGetRequest
     */
    public function getByCustomerId($customerId)
    {
        $request = CartByCustomerIdGetRequest::ofCustomerId($customerId);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#get-cart-by-id
     * @param string $id
     * @return CartByIdGetRequest
     */
    public function getById($id)
    {
        $request = CartByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#create-cart
     * @param CartDraft $cartDraft
     * @return CartCreateRequest
     */
    public function create(CartDraft $cartDraft)
    {
        $request = CartCreateRequest::ofDraft($cartDraft);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#delete-cart
     * @param Cart $cart
     * @return CartDeleteRequest
     */
    public function delete(Cart $cart)
    {
        $request = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#query-carts
     *
     * @return CartQueryRequest
     */
    public function query()
    {
        $request = CartQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#replicate-existing-cart-or-order-to-a-new-cart
     * @param string $cartId
     * @return CartReplicateRequest
     */
    public function replicate($cartId)
    {
        $request = CartReplicateRequest::ofCartId($cartId);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-carts.html#update-cart
     * @param Cart $cart
     * @return CartUpdateRequest
     */
    public function update(Cart $cart)
    {
        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        return $request;
    }

    /**
     * @return CartRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
