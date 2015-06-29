<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Cart;

use Sphere\Core\ApiTestCase;
use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\Request\Carts\CartCreateRequest;
use Sphere\Core\Request\Carts\CartDeleteByIdRequest;

class CartCreateTest extends ApiTestCase
{
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
        $cartResponse = $this->getClient()
            ->execute(CartCreateRequest::ofDraft($draft));

        $cart = $cartResponse->toObject();

        $this->cleanupRequests[] = CartDeleteByIdRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());

        return $cart;
    }


    public function testCreate()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);
        $this->assertSame($draft->getCurrency(), $cart->getTotalPrice()->getCurrencyCode());
        $this->assertSame($draft->getCountry(), $cart->getCountry());
        $this->assertSame(0, $cart->getTotalPrice()->getCentAmount());
    }
}
