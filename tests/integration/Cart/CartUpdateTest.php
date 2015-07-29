<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Cart;

use Sphere\Core\ApiTestCase;
use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\Model\Common\Address;
use Sphere\Core\Request\Carts\CartCreateRequest;
use Sphere\Core\Request\Carts\CartDeleteRequest;
use Sphere\Core\Request\Carts\CartUpdateRequest;
use Sphere\Core\Request\Carts\Command\CartSetShippingAddressAction;

class CartUpdateTest extends ApiTestCase
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
