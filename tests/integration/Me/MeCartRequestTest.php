<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Me;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Me\MeCartByIdRequest;
use Commercetools\Core\Request\Me\MeCartQueryRequest;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

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

    public function testMyCart()
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

        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler(dirname(__DIR__) .'/requests.log', LogLevel::NOTICE));

        $client = Client::ofConfigAndLogger($config, $logger);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertSame($cart->getId(), $result->getId());
    }

    public function testNoAccess()
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

        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler(dirname(__DIR__) .'/requests.log', LogLevel::NOTICE));

        $client = Client::ofConfigAndLogger($config, $logger);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeCartByIdRequest::ofId($cart->getId());
        $response = $request->executeWithClient($client);

        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Error\ResourceNotFoundError', $response->getErrors()->current());
    }

    public function testQuery()
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

        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler(dirname(__DIR__) .'/requests.log', LogLevel::NOTICE));

        $client = Client::ofConfigAndLogger($config, $logger);
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
