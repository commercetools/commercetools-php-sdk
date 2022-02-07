<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CartQueryRequestTest extends ApiTestCase
{
    public function testGetById()
    {
        $client = $this->getApiClient();

        CartFixture::withCustomerCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->getById($cart->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Cart::class, $result);
                $this->assertSame($cart->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        CartFixture::withCustomerCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->getByKey($cart->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Cart::class, $result);
                $this->assertSame($cart->getKey(), $result->getKey());
            }
        );
    }

    public function testQuery()
    {
        $client = $this->getApiClient();

        CartFixture::withCustomerCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->query()
                     ->where('customerEmail=:customerEmail', ['customerEmail' => $cart->getCustomerEmail()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Cart::class, $result->current());
                $this->assertSame($cart->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetByCustomerId()
    {
        $client = $this->getApiClient();

        CartFixture::withCustomerCart(
            $client,
            function (Cart $cart) use ($client) {
                $request = RequestBuilder::of()->carts()->getByCustomerId($cart->getCustomerId());
                $response = $this->execute($client, $request, ['X-Vrap-Disable-Validation' => 'response']);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Cart::class, $result);
                $this->assertSame($cart->getId(), $result->getId());
            }
        );
    }

    public function testGetByIdInStore()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CartFixture::withDraftCustomerCart(
                    $client,
                    function (CartDraft $cartDraft) use ($store) {
                        return $cartDraft->setStore(StoreReference::ofKey($store->getKey()));
                    },
                    function (Cart $cart) use ($client, $store) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->carts()->getById($cart->getId())
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Cart::class, $result);
                        $this->assertSame($cart->getCountry(), $result->getCountry());
                        $this->assertSame(
                            'in-store/key=' . $store->getKey() . '/carts/'.$result->getId(),
                            (string)$request->httpRequest()->getUri()
                        );
                        $this->assertSame($store->getKey(), $result->getStore()->getKey());
                    }
                );
            }
        );
    }

    public function testGetByKeyInStore()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CartFixture::withDraftCustomerCart(
                    $client,
                    function (CartDraft $cartDraft) use ($store) {
                        return $cartDraft->setStore(StoreReference::ofKey($store->getKey()));
                    },
                    function (Cart $cart) use ($client, $store) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->carts()->getByKey($cart->getKey())
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Cart::class, $result);
                        $this->assertSame($cart->getCountry(), $result->getCountry());
                        $this->assertSame(
                            'in-store/key=' . $store->getKey() . '/carts/key='. $result->getKey(),
                            (string)$request->httpRequest()->getUri()
                        );
                        $this->assertSame($store->getKey(), $result->getStore()->getKey());
                    }
                );
            }
        );
    }

    public function testQueryInStore()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CartFixture::withDraftCustomerCart(
                    $client,
                    function (CartDraft $cartDraft) use ($store) {
                        return $cartDraft->setStore(StoreReference::ofKey($store->getKey()));
                    },
                    function (Cart $cart) use ($client, $store) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->carts()->query()
                                ->where('customerEmail=:customerEmail', ['customerEmail' => $cart->getCustomerEmail()])
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(CartCollection::class, $result);
                        $this->assertStringStartsWith(
                            'in-store/key=' . $store->getKey() . '/carts',
                            (string)$request->httpRequest()->getUri()
                        );
                        $this->assertCount(1, $result);
                        $this->assertInstanceOf(Cart::class, $result->current());
                        $this->assertSame($cart->getId(), $result->current()->getId());
                        $this->assertSame($store->getKey(), $result->current()->getStore()->getKey());
                    }
                );
            }
        );
    }

    public function testGetByIdNotInStore()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CartFixture::withCustomerCart(
                    $client,
                    function (Cart $cart) use ($client, $store) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->carts()->getById($cart->getId())
                        );
                        $response = $this->execute($client, $request);
                        $request->mapFromResponse($response);
                    }
                );
            }
        );
    }

    public function testGetByKeyNotInStore()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CartFixture::withCustomerCart(
                    $client,
                    function (Cart $cart) use ($client, $store) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->carts()->getByKey($cart->getKey())
                        );
                        $response = $this->execute($client, $request);
                        $request->mapFromResponse($response);
                    }
                );
            }
        );
    }
}
