<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

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
        $client = $this->getApiClient();

        CartFixture::withCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->query()
                    ->where('id=:id', ['id' => $cart->getId()]);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame(
                    $cart->getTotalPrice()->getCurrencyCode(),
                    $result->current()->getTotalPrice()->getCurrencyCode()
                );
                $this->assertSame($cart->getCountry(), $result->current()->getCountry());
                $this->assertSame(0, $result->current()->getTotalPrice()->getCentAmount());
            }
        );
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
        if ($successful == false) {
            $this->expectException(FixtureException::class);
            $this->expectExceptionCode(400);
        }

        $client = $this->getApiClient();

        CartFixture::withDraftCart(
            $client,
            function (CartDraft $draft) use ($originType) {
                return $draft->setOrigin($originType);
            },
            function (Cart $cart) use ($client, $originType, $successful) {
                $this->assertSame($originType, $cart->getOrigin());
            }
        );
    }

    public function testCreateReplicaCartFromCart()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                CartFixture::withUpdateableCart(
                    $client,
                    function (Cart $cart) use ($client, $product) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                        $request = RequestBuilder::of()->carts()->update($cart)
                            ->addAction(
                                CartAddLineItemAction::ofProductIdVariantIdAndQuantity(
                                    $product->getId(),
                                    $variant->getId(),
                                    1
                                )
                            );
                        $response = $client->execute($request);
                        $cart = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Cart::class, $cart);

                        $request = RequestBuilder::of()->carts()->replicate($cart->getId());
                        $response = $client->execute($request);
                        $replicaCart = $request->mapFromResponse($response);

                        $this->assertNotEmpty($replicaCart->getLineItems());

                        $cartLineItem = $cart->getLineItems()->current()->getProductId();
                        $replicaCartLineItem = $replicaCart->getLineItems()->current()->getProductId();

                        $this->assertSame($cartLineItem, $replicaCartLineItem);
                        $this->assertNotSame($cart->getId(), $replicaCart->getId());
                        $this->assertSame(CartState::ACTIVE, $replicaCart->getCartState());

                        return $replicaCart;
                    }
                );
            }
        );
    }
//todo need InStoreRequestDecorator?
    public function testCreateCartInStore()
    {
        $store = $this->getStore();
        $cartDraft = $this->getDraft();

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), CartCreateRequest::ofDraft($cartDraft));
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapFromResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion($cart->getId(), $cart->getVersion());

        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertSame($cartDraft->getCountry(), $cart->getCountry());
        $this->assertSame('in-store/key='.$store->getKey().'/carts', (string)$request->httpRequest()->getUri());
        $this->assertSame($store->getKey(), $cart->getStore()->getKey());
    }
}
