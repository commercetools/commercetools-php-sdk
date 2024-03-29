<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;

class OrderQueryRequestTest extends ApiTestCase
{
    public function testGetById()
    {
        $client = $this->getApiClient();

        OrderFixture::withOrder(
            $client,
            function (Order $order) use ($client) {
                $request = RequestBuilder::of()->orders()->getById($order->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Order::class, $result);
                $this->assertSame($order->getId(), $result->getId());
            }
        );
    }

    public function testQuery()
    {
        $client = $this->getApiClient();

        OrderFixture::withOrder(
            $client,
            function (Order $order) use ($client) {
                $request = RequestBuilder::of()->orders()->query()->where(
                    'customerEmail=:customerEmail',
                    ['customerEmail' => $order->getCustomerEmail()]
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Order::class, $result->current());
                $this->assertSame($order->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetByIdInStore()
    {
        $client = $this->getApiClient();

        OrderFixture::withStoreOrder(
            $client,
            function (Order $order, Store $store) use ($client) {
                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->orders()->getById($order->getId())
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Order::class, $result);
                $this->assertSame($order->getId(), $result->getId());
                $this->assertSame('in-store/key='.$store->getKey().'/orders/'.$result->getId(), (string)$request->httpRequest()->getUri());
                $this->assertSame($store->getKey(), $result->getStore()->getKey());
            }
        );
    }

    public function testQueryInStore()
    {
        $client = $this->getApiClient();

        OrderFixture::withStoreOrder(
            $client,
            function (Order $order, Store $store) use ($client) {
                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->orders()->query()
                    ->where(
                        'customerEmail=:customerEmail',
                        ['customerEmail' => $order->getCustomerEmail()]
                    )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(OrderCollection::class, $result);
                $this->assertStringStartsWith('in-store/key='.$store->getKey().'/orders', (string)$request->httpRequest()->getUri());
                $this->assertCount(1, $result);
                $this->assertInstanceOf(Order::class, $result->getAt(0));
                $this->assertSame($order->getId(), $result->getAt(0)->getId());
                $this->assertSame($store->getKey(), $result->getAt(0)->getStore()->getKey());
            }
        );
    }
}
