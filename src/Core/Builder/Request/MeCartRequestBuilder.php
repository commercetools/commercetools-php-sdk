<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\MyCartDraft;
use Commercetools\Core\Request\Me\MeActiveCartRequest;
use Commercetools\Core\Request\Me\MeCartByIdRequest;
use Commercetools\Core\Request\Me\MeCartCreateRequest;
use Commercetools\Core\Request\Me\MeCartQueryRequest;
use Commercetools\Core\Request\Me\MeCartUpdateRequest;

class MeCartRequestBuilder
{
    /**
     * @return MeActiveCartRequest
     */
    public function getActiveCart()
    {
        return MeActiveCartRequest::of();
    }

    /**
     * @return MeCartQueryRequest
     */
    public function query()
    {
        return MeCartQueryRequest::of();
    }

    /**
     * @param Cart $cart
     * @return MeCartUpdateRequest
     */
    public function update(Cart $cart)
    {
        return MeCartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
    }

    /**
     * @param string $cartId
     * @return MeCartByIdRequest
     */
    public function getById($cartId)
    {
        return MeCartByIdRequest::ofId($cartId);
    }

    /**
     * @param MyCartDraft $cartDraft
     * @return MeCartCreateRequest
     */
    public function create(MyCartDraft $cartDraft)
    {
        return MeCartCreateRequest::ofDraft($cartDraft);
    }
}
