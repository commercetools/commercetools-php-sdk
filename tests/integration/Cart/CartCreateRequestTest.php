<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\DiscountCode\DiscountCodeFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Carts\Command\CartAddLineItemAction;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CartCreateRequestTest extends ApiTestCase
{
    public function testCreate()
    {
        $client = $this->getApiClient();

        CartFixture::withCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->query()
                    ->where('id=:id', ['id' => $cart->getId()]);
                $response = $this->execute($client, $request);
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

    public function testCreateWithDiscount()
    {
        $client = $this->getApiClient();
        DiscountCodeFixture::withActiveDiscountCode(
            $client,
            function (DiscountCode $discountCode) use ($client) {
                CartFixture::withDraftCart(
                    $client,
                    function (CartDraft $draft) use ($discountCode) {
                        return $draft->setCountry("DE")->setCurrency("EUR")->setDiscountCodes([$discountCode->getCode()]);
                    },
                    function (Cart $cart) use ($client, $discountCode) {
                        $this->assertSame($discountCode->getId(), $cart->getDiscountCodes()->current()->getDiscountCode()->getId());
                    }
                );
            }
        );
    }

    public function testCreateReplicaCartFromCart()
    {
        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
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
                        $response = $this->execute($client, $request);
                        $cart = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Cart::class, $cart);

                        $request = RequestBuilder::of()->carts()->replicate($cart->getId());
                        $response = $this->execute($client, $request);
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

    public function testCreateCartInStore()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $cartDraft = CartDraft::ofCurrency('EUR')->setCountry('DE');
                $cartRequest = RequestBuilder::of()->carts()->create($cartDraft);
                $createRequest = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), $cartRequest);
                $response = $this->execute($client, $createRequest);
                $result = $createRequest->mapFromResponse($response);

                $cartRequest = RequestBuilder::of()->carts()->delete($result);
                $deleteRequest = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), $cartRequest);
                $response = $this->execute($client, $deleteRequest);
                $result = $deleteRequest->mapFromResponse($response);

                $this->assertInstanceOf(Cart::class, $result);
                $this->assertSame($cartDraft->getCountry(), $result->getCountry());
                $this->assertSame('in-store/key=' . $store->getKey() . '/carts', (string)$createRequest->httpRequest()->getUri());
                $this->assertSame($store->getKey(), $result->getStore()->getKey());
            }
        );
    }
}
