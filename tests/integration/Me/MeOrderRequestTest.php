<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Me;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ResourceNotFoundError;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Cart\MyCartDraft;
use Commercetools\Core\Model\Cart\MyLineItemDraft;
use Commercetools\Core\Model\Cart\MyLineItemDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\Me\MeCartCreateRequest;
use Commercetools\Core\Request\Me\MeOrderByIdRequest;
use Commercetools\Core\Request\Me\MeOrderQueryRequest;
use Commercetools\Core\Request\Me\MeOrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Monolog\Handler\TestHandler;
use Monolog\Logger;

class MeOrderRequestTest extends ApiTestCase
{
    /**
     * @return CartDraft
     */
    protected function getCartDraft()
    {
        $draft = CartDraft::ofCurrencyAndCountry('EUR', 'DE');
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $draft->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setLineItems(
                LineItemDraftCollection::of()
                    ->add(
                        LineItemDraft::ofProductIdVariantIdAndQuantity($this->getProduct()->getId(), 1, 1)
                    )
            );
        $draft->setShippingMethod($this->getShippingMethod()->getReference());

        return $draft;
    }

    /**
     * @return MyCartDraft
     */
    protected function getMyCartDraft()
    {
        $draft = MyCartDraft::ofCurrency('EUR')->setCountry('DE');
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $draft->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setLineItems(
                MyLineItemDraftCollection::of()
                    ->add(
                        MyLineItemDraft::ofProductIdVariantIdAndQuantity($this->getProduct()->getId(), 1, 1)
                    )
            );
        $draft->setShippingMethod($this->getShippingMethod()->getReference());

        return $draft;
    }

    /**
     * @param CartDraft $draft
     * @return Order
     */
    protected function createOrder(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = $cartDeleteRequest = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $orderRequest = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = OrderDeleteRequest::ofIdAndVersion(
            $order->getId(),
            $order->getVersion()
        );

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $cartDeleteRequest->setVersion($cart->getVersion());

        return $order;
    }

    /**
     * @param $client
     * @param MyCartDraft $draft
     * @return Order
     */
    protected function createMyOrder($client, MyCartDraft $draft)
    {
        $request = MeCartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);

        $this->cleanupRequests[] = $cartDeleteRequest = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $request = MeOrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        $response = $request->executeWithClient($client);
        $order = $request->mapResponse($response);

        $this->cleanupRequests[] = OrderDeleteRequest::ofIdAndVersion(
            $order->getId(),
            $order->getVersion()
        );

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $cartDeleteRequest->setVersion($cart->getVersion());

        return $order;
    }

    public function testCustomerGetMyOrder()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $cartDraft->setCustomerId($customer->getId());
        $order = $this->createOrder($cartDraft);

        $config = $this->getClientConfig('manage_my_orders');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $handler = new TestHandler();
        $logger = new Logger('testOauth');
        $logger->pushHandler($handler);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()])->setLogger($logger);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeOrderByIdRequest::ofId($order->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($order->getId(), $result->getId());
    }

    public function testCustomerNoAccess()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $config = $this->getClientConfig('manage_my_orders');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $handler = new TestHandler();
        $logger = new Logger('testOauth');
        $logger->pushHandler($handler);

        $cache = new ArrayCachePool();

        $client = Client::ofConfigCacheAndLogger($config, $cache, $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()])->setLogger($logger);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeOrderByIdRequest::ofId($order->getId());
        $response = $request->executeWithClient($client);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(ResourceNotFoundError::class, $response->getErrors()->current());
    }

    public function testCustomerQuery()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $order1 = $this->createOrder($cartDraft);

        $cartDraft->setCustomerId($customer->getId());
        $order2 = $this->createOrder($cartDraft);
        $order3 = $this->createOrder($cartDraft);

        $config = $this->getClientConfig('manage_my_orders');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $cache = new ArrayCachePool();
        $client = Client::ofConfigCacheAndLogger($config, $cache, $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeOrderQueryRequest::of();
        $response = $request->executeWithClient($client);
        $orders = $request->mapResponse($response);

        $this->assertCount(2, $orders);
        $this->assertNull($orders->getById($order1->getId()));
        $this->assertSame($order2->getId(), $orders->getById($order2->getId())->getId());
        $this->assertSame($order3->getId(), $orders->getById($order3->getId())->getId());
    }

    public function testCustomerCreateMyOrder()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customerDraft->getEmail())
            ->setPassword($customerDraft->getPassword());

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $order = $this->createMyOrder($client, $cartDraft);

        $this->assertSame($customer->getId(), $order->getCustomerId());

        $request = MeOrderByIdRequest::ofId($order->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($order->getId(), $result->getId());
        $this->assertSame($customer->getId(), $result->getCustomerId());
    }

    public function testAnonMyOrderWithId()
    {
        $anonId = uniqid();
        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS)
            ->setAnonymousId($anonId);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $order = $this->createMyOrder($client, $cartDraft);

        $this->assertSame($anonId, $order->getAnonymousId());

        $request = MeOrderByIdRequest::ofId($order->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($order->getId(), $result->getId());
        $this->assertSame($anonId, $result->getAnonymousId());
    }

    public function testAnonMyOrder()
    {
        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $order = $this->createMyOrder($client, $cartDraft);

        $this->assertNotEmpty($order->getAnonymousId());

        $request = MeOrderByIdRequest::ofId($order->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($order->getId(), $result->getId());
        $this->assertSame($order->getAnonymousId(), $result->getAnonymousId());
    }

    public function testCustomerCreateMyOrderInStore()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $store = $this->getStore();

        $config = $this->getClientConfig(['manage_my_orders']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customerDraft->getEmail())
            ->setPassword($customerDraft->getPassword());

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), MeCartCreateRequest::ofDraft($cartDraft));
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);

        $this->cleanupRequests[] = $cartDeleteRequest = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), MeOrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion()));
        $response = $request->executeWithClient($client);
        $order = $request->mapResponse($response);

        $this->cleanupRequests[] = OrderDeleteRequest::ofIdAndVersion(
            $order->getId(),
            $order->getVersion()
        );

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $cartDeleteRequest->setVersion($cart->getVersion());

        $this->assertSame($customer->getId(), $order->getCustomerId());

        $request = InStoreRequestDecorator::ofStoreKeyAndRequest($store->getKey(), MeOrderByIdRequest::ofId($order->getId()));
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($order->getId(), $result->getId());
        $this->assertSame($customer->getId(), $result->getCustomerId());
    }
}
