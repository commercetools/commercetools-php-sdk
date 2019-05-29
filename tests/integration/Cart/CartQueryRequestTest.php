<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CartQueryRequestTest extends ApiTestCase
{
    /**
     * @return CartDraft
     */
    protected function getDraft()
    {
        $draft = CartDraft::ofCurrency(
            'EUR'
        );
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setCountry('DE')
//            ->setLineItems(
//                LineItemDraftCollection::of()
//                    ->add(
//                        LineItemDraft::of()
//                    )
//            )
            ->setShippingMethod($this->getShippingMethod()->getReference())
        ;

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        return $cart;
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Cart::class, $result);
        $this->assertSame($cart->getId(), $result->getId());
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartQueryRequest::of()->where(
            'customerEmail="' . $draft->getCustomerEmail() . '"'
        );

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Cart::class, $result->getAt(0));
        $this->assertSame($cart->getId(), $result->getAt(0)->getId());
    }

    public function testGetByCustomerId()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartByCustomerIdGetRequest::ofCustomerId($cart->getCustomerId());
        $response = $request->executeWithClient($this->getClient(), ['X-Vrap-Disable-Validation' => 'response']);
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Cart::class, $result);
        $this->assertSame($cart->getId(), $result->getId());
    }

    public function testGetByIdInStore()
    {
        $store = $this->getStore();
        $cartDraft = $this->getDraft()->setStore(StoreReference::ofKey($store->getKey()));
        $cart = $this->createCart($cartDraft);

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), CartByIdGetRequest::ofId($cart->getId()));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);

        $this->assertInstanceOf(Cart::class, $result);
        $this->assertSame($cartDraft->getCountry(), $result->getCountry());
        $this->assertSame('in-store/key='.$store->getKey().'/carts/'.$result->getId(), (string)$request->httpRequest()->getUri());
        $this->assertSame($store->getKey(), $result->getStore()->getKey());
    }

    public function testQueryInStore()
    {
        $store = $this->getStore();
        $cartDraft = $this->getDraft()->setStore(StoreReference::ofKey($store->getKey()));
        $cart = $this->createCart($cartDraft);

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), CartQueryRequest::of()->where(
            'customerEmail="' . $cartDraft->getCustomerEmail() . '"'
        ));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);

        $this->assertInstanceOf(CartCollection::class, $result);
        $this->assertStringStartsWith('in-store/key='.$store->getKey().'/carts', (string)$request->httpRequest()->getUri());
        $this->assertCount(1, $result);
        $this->assertInstanceOf(Cart::class, $result->getAt(0));
        $this->assertSame($cart->getId(), $result->getAt(0)->getId());
        $this->assertSame($store->getKey(), $result->getAt(0)->getStore()->getKey());
    }
}
