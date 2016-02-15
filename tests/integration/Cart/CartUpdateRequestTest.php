<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
use Commercetools\Core\Request\Carts\Command\CartSetShippingAddressAction;

class CartUpdateRequestTest extends ApiTestCase
{
    /**
     * @var CartDeleteRequest
     */
    protected $cartDeleteRequest;
    /**
     * @return CartDraft
     */
    protected function getDraft()
    {
        $draft = CartDraft::ofCurrency('EUR')->setCountry('DE');

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        /**
         * @var Cart $cart
         */
        $cart = $this->getClient()
            ->execute(CartCreateRequest::ofDraft($draft))
            ->toObject();
        $this->cartDeleteRequest = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        $this->cleanupRequests[] = $this->cartDeleteRequest;

        return $cart;
    }

    protected function getShippingAddress()
    {
        $cart = $this->createCart($this->getDraft());
        $address = Address::of()->setCountry('DE');
        /**
         * @var Cart $cart
         */
        $cart = $this->getClient()->execute(
            CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
                ->addAction(CartSetShippingAddressAction::of()->setAddress($address))
        )->toObject();
        $this->cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($address->getCountry(), $cart->getShippingAddress()->getCountry());

        $cart = $this->getClient()->execute(
            CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
                ->addAction(CartSetShippingAddressAction::of())
        )->toObject();
        $this->cartDeleteRequest->setVersion($cart->getVersion());
        $this->assertNull($cart->getShippingAddress());
    }

    public function testAddLineItem()
    {
        $this->getShippingAddress();
    }
}
