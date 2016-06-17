<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Me;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Client\OAuth\Manager;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\MyCartDraft;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Me\MeCartByIdRequest;
use Commercetools\Core\Request\Me\MeCartCreateRequest;
use Commercetools\Core\Request\Me\MeCartQueryRequest;
use Monolog\Handler\TestHandler;
use Monolog\Logger;

class MeCartRequestTest extends ApiTestCase
{
    /**
     * @return CartDraft
     */
    protected function getCartDraft()
    {
        $draft = CartDraft::ofCurrency(
            'EUR'
        );
        $draft
            ->setCountry('DE')
        ;

        return $draft;
    }

    /**
     * @return MyCartDraft
     */
    protected function getMyCartDraft()
    {
        $draft = MyCartDraft::ofCurrency(
            'EUR'
        );
        $draft
            ->setCountry('DE')
        ;

        return $draft;
    }

    protected function createCart(CartDraft $draft, $client = null)
    {
        if (is_null($client)) {
            $client = $this->getClient();
        }
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        return $cart;
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->getCache()->clear();
    }


    public function testAnonOauth()
    {
        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS);

        $testHandler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($testHandler);

        $manager = new Manager($config, $this->getCache());
        $client = $manager->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->setLogger($logger);

        $token = $manager->refreshToken();

        $this->assertNotEmpty($token->getToken());

        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $config->setGrantType(Config::GRANT_TYPE_REFRESH)->setRefreshToken($token->getRefreshToken());
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $this->assertCount(1, $testHandler->getRecords());
    }

    public function testAnonIdOAuth()
    {
        $anonId = uniqid();
        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS)
            ->setAnonymousId($anonId)
        ;

        $testHandler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($testHandler);

        $manager = new Manager($config, $this->getCache());
        $client = $manager->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->setLogger($logger);

        $token = $manager->refreshToken();

        $this->assertNotEmpty($token->getToken());

        $config->setGrantType(Config::GRANT_TYPE_REFRESH)->setRefreshToken($token->getRefreshToken());
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS)->setAnonymousId($anonId);
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $this->assertCount(1, $testHandler->getRecords());
        $this->assertContains('anonymous', current($testHandler->getRecords())['message']);
    }

    public function testCustomerOAuth()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $testHandler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($testHandler);

        $manager = new Manager($config, $this->getCache());
        $client = $manager->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->setLogger($logger);

        $token = $manager->refreshToken();

        $this->assertNotEmpty($token->getToken());

        $config->setGrantType(Config::GRANT_TYPE_REFRESH)->setRefreshToken($token->getRefreshToken());
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)->setUsername($customer->getEmail());
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());

        $this->assertCount(1, $testHandler->getRecords());
    }

    public function testCustomerRefreshTokenOAuth()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['view_products', 'manage_my_profile', 'manage_my_orders']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $testHandler = new TestHandler();
        $logger = new Logger('test');
        $logger->pushHandler($testHandler);

        $manager = new Manager($config, $this->getCache());
        $client = $manager->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->setLogger($logger);

        $token = $manager->refreshToken();

        $this->assertNotEmpty($token->getToken());
        $this->assertSame($token->getToken(), $manager->getToken()->getToken());
        $this->assertCount(1, $testHandler->getRecords());

        $config->setGrantType(Config::GRANT_TYPE_REFRESH)->setRefreshToken($token->getRefreshToken());

        $newToken = $manager->refreshToken();
        $this->assertNotEmpty($newToken->getToken());
        $this->assertNotSame($token->getToken(), $newToken->getToken());
        $this->assertNull($newToken->getRefreshToken());
        $this->assertCount(2, $testHandler->getRecords());
    }

    public function testAnonMyCart()
    {
        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $request = MeCartCreateRequest::ofDraft($cartDraft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $this->assertNotEmpty($cart->getAnonymousId());

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($cart->getId(), $result->getId());
        $this->assertSame($cart->getAnonymousId(), $result->getAnonymousId());
    }

    public function testAnonQueryCart()
    {
        $cartDraft = $this->getCartDraft();
        $cart1 = $this->createCart($cartDraft);

        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $request = MeCartCreateRequest::ofDraft($cartDraft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $this->assertNotEmpty($cart->getAnonymousId());

        $request = MeCartQueryRequest::of();
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertNull($result->getById($cart1->getId()));
        $this->assertSame($cart->getId(), $result->getById($cart->getId())->getId());
        $this->assertSame($cart->getAnonymousId(), $result->getById($cart->getId())->getAnonymousId());
    }

    /**
     * @expectedException \Commercetools\Core\Error\BadRequestException
     */
    public function testAnonCartExistsForId()
    {
        $anonId = uniqid();
        $cartDraft = $this->getCartDraft();
        $cartDraft->setAnonymousId($anonId);
        $this->createCart($cartDraft);

        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS)
            ->setAnonymousId($anonId);

        $manager = new Manager($config, $this->getCache());
        $manager->getHttpClient(['verify' => $this->getVerifySSL()]);
        $manager->refreshToken();
    }

    public function testAnonMyCartWithId()
    {
        $anonId = uniqid();
        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS)
            ->setAnonymousId($anonId);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $request = MeCartCreateRequest::ofDraft($cartDraft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $this->assertSame($anonId, $cart->getAnonymousId());

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($cart->getId(), $result->getId());
        $this->assertSame($anonId, $result->getAnonymousId());
    }

    public function testCustomerCreateMyCart()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_orders', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customerDraft->getEmail())
            ->setPassword($customerDraft->getPassword());

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $cartDraft = $this->getMyCartDraft();
        $request = MeCartCreateRequest::ofDraft($cartDraft);
        $response = $request->executeWithClient($client);
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $this->assertSame($customer->getId(), $cart->getCustomerId());

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($cart->getId(), $result->getId());
        $this->assertSame($customer->getId(), $result->getCustomerId());
    }

    public function testCustomerGetMyCart()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $cartDraft->setCustomerId($customer->getId());
        $cart = $this->createCart($cartDraft);

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

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($cart->getId(), $result->getId());
    }

    public function testCustomerNoAccess()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $cart = $this->createCart($cartDraft);

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($cart->getId(), $result->getId());

        $config = $this->getClientConfig('manage_my_orders');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);

        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Error\ResourceNotFoundError', $response->getErrors()->current());
    }

    public function testCustomerQuery()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $cartDraft = $this->getCartDraft();
        $cart1 = $this->createCart($cartDraft);

        $cartDraft->setCustomerId($customer->getId());
        $cart2 = $this->createCart($cartDraft);
        $cart3 = $this->createCart($cartDraft);

        $config = $this->getClientConfig('manage_my_orders');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($customerDraft->getPassword())
        ;

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeCartQueryRequest::of();
        $response = $request->executeWithClient($client);
        $carts = $request->mapResponse($response);

        $this->assertCount(2, $carts);
        $this->assertNull($carts->getById($cart1->getId()));
        $this->assertSame($cart2->getId(), $carts->getById($cart2->getId())->getId());
        $this->assertSame($cart3->getId(), $carts->getById($cart3->getId())->getId());
    }
}
