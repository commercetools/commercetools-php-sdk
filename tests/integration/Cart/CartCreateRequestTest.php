<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Cart\ReplicaCartDraft;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartReplicateRequest;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;


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
            $this->cleanupRequests[] = $this->deleteRequest = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());
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

    public function testCreateReplicaCartFromCart()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $request = CartUpdateRequest::ofIdAndVersion($cart->getId(), $cart->getVersion())
            ->addAction(
                CartAddLineItemAction::ofProductIdVariantIdAndQuantity($product->getId(), $variant->getId(), 1)
            )
        ;

        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->assertFalse($response->isError());

        $this->deleteRequest->setVersion($cart->getVersion());

        $reference = CartReference::ofId($cart->getId());
        $replicaDraft = ReplicaCartDraft::ofCart($reference);

        $request = CartReplicateRequest::ofReplicaCartDraft($replicaDraft);
        $response = $request->executeWithClient($this->getClient());
        $replicaCart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion($replicaCart->getId(), $replicaCart->getVersion());

        $this->assertNotEmpty($replicaCart->getLineItems());

        $cartLineItem = $cart->getLineItems()->current()->getProductId();
        $replicaCartLineItem = $replicaCart->getLineItems()->current()->getProductId();

        $this->assertSame($cartLineItem, $replicaCartLineItem);
        $this->assertNotSame($cart->getId(), $replicaCart->getId());
        $this->assertSame(CartState::ACTIVE, $replicaCart->getCartState());
    }
}
