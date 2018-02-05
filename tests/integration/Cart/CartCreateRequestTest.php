<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;

class CartCreateRequestTest extends ApiTestCase
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
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        if ($cart != null) {
            $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
        }

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

    public function getOriginTypes()
    {
        return [
            Cart::ORIGIN_CUSTOMER => [Cart::ORIGIN_CUSTOMER, true],
            Cart::ORIGIN_MERCHANT => [Cart::ORIGIN_MERCHANT, true],
            'invalidOrigin' => ['invalidOrigin', false],
        ];
    }
    /**
     * @dataProvider getOriginTypes()
     */
    public function testCreateOriginCustom($originType, $successful)
    {
        $draft = $this->getDraft();
        $draft->setOrigin($originType);
        $cart = $this->createCart($draft);
        if ($successful) {
            $this->assertSame($originType, $cart->getOrigin());
        } else {
            $this->assertNull($cart);
        }
    }
}
