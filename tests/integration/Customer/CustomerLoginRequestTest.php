<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Customer;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerByTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordChangeRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordResetRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

class CustomerLoginRequestTest extends ApiTestCase
{
    /**
     * @return CustomerDraft
     */
    protected function getDraft($name)
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'TEST-' . $this->getTestRun() . '-em.ail+sphere@example.org',
            'test-' . $this->getTestRun() . '-' . $name,
            'test-' . $this->getTestRun() . '-lastName',
            'test-' . $this->getTestRun() . '-password'
        );

        return $draft;
    }

    protected function createCustomer(CustomerDraft $draft)
    {
        $request = CustomerCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        return $result->getCustomer();
    }

    public function testLoginSuccess()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), $draft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testLoginSuccessLowerCased()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);
        $email = strtolower($customer->getEmail());
        $this->assertNotSame($customer->getEmail(), $email);

        $request = CustomerLoginRequest::ofEmailAndPassword($email, $draft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertFalse($response->isError());
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testLoginFailure()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testLoginFailureLowercased()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);
        $email = strtolower($customer->getEmail());
        $this->assertNotSame($customer->getEmail(), $email);

        $request = CustomerLoginRequest::ofEmailAndPassword($email, $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testChangePasswordSuccess()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            $draft->getPassword(),
            $this->getTestRun()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame($customer->getId(), $result->getId());
    }

    public function testChangePasswordFailure()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            $this->getTestRun(),
            $draft->getPassword()
        );
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
    }

    public function testPasswordReset()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerPasswordTokenRequest::ofEmail(
            $customer->getEmail()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $token = $result->getValue();
        $this->assertNotEmpty($token);

        $request = CustomerByTokenGetRequest::ofToken(
            $token
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->assertSame($customer->getId(), $result->getId());

        $request = CustomerPasswordResetRequest::ofTokenAndPassword(
            $token,
            $this->getTestRun()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertSame($customer->getId(), $result->getId());

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($customer->getId(), $result->getCustomer()->getId());

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), $draft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
    }

    public function testPasswordResetLowerCased()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);
        $email = strtolower($customer->getEmail());
        $this->assertNotSame($customer->getEmail(), $email);

        $request = CustomerPasswordTokenRequest::ofEmail(
            $email
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertFalse($response->isError());
        $token = $result->getValue();
        $this->assertNotEmpty($token);

        $request = CustomerByTokenGetRequest::ofToken(
            $token
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->assertSame($customer->getId(), $result->getId());

        $request = CustomerPasswordResetRequest::ofTokenAndPassword(
            $token,
            $this->getTestRun()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertFalse($response->isError());
        $this->assertSame($customer->getId(), $result->getId());

        $request = CustomerLoginRequest::ofEmailAndPassword($email, $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertFalse($response->isError());
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());

        $request = CustomerLoginRequest::ofEmailAndPassword($email, $draft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
    }

    public function testVerifyEmail()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $this->assertFalse($customer->getIsEmailVerified());

        $request = CustomerEmailTokenRequest::ofIdVersionAndTtl(
            $customer->getId(),
            $customer->getVersion(),
            15
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $token = $result->getValue();
        $this->assertNotEmpty($token);

        $request = CustomerEmailConfirmRequest::ofToken(
            $token
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertTrue($result->getIsEmailVerified());
    }

    public function testDuplicateLowerCased()
    {
        $draft = $this->getDraft('email');
        $this->createCustomer($draft);

        $request = CustomerCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertSame(400, $response->getStatusCode());
        $this->assertInstanceOf('\Commercetools\Core\Error\DuplicateFieldError', $response->getErrors()->current());
    }

    public function testAuthLogin()
    {
        $draft = $this->getDraft('email');
        $this->createCustomer($draft);
        
        $email = $draft->getEmail();
        $password = $draft->getPassword();
        
        $config = $this->getClientConfig('view_products');
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)->setUsername($email)->setPassword($password);

        $logger = new Logger('test');
        $logger->pushHandler(new StreamHandler(dirname(__DIR__) .'/requests.log', LogLevel::NOTICE));

        $client = Client::ofConfigAndLogger($config, $logger);
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()]);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $token = $client->getOauthManager()->refreshToken();

        $this->assertInstanceOf('\Commercetools\Core\Client\OAuth\Token', $token);
        $this->assertSame(Config::GRANT_TYPE_PASSWORD, $config->getGrantType());
        $this->assertNotEmpty($config->getRefreshToken());

        $refreshToken = $token->getRefreshToken();
        $this->assertNotEmpty($refreshToken);

        $cacheToken = $client->getOauthManager()->getToken();
        $this->assertSame($cacheToken->getToken(), $token->getToken());

        $forceRefreshToken = $client->getOauthManager()->refreshToken();
        $this->assertNotSame($token->getToken(), $forceRefreshToken->getToken());
    }

    public function testCartNewOnLogin()
    {
        $client = $this->getClient();

        $customerDraft = $this->getCustomerDraft();
        $customer = $this->createCustomer($customerDraft);

        $customerCartDraft = $this->getCartDraft();
        $customerCartDraft->setCustomerId($customer->getId());
        $customerCart = $this->getCart($customerCartDraft);

        $anonCartDraft = $this->getCartDraft();
        $request = CartCreateRequest::ofDraft($anonCartDraft);
        $response = $request->executeWithClient($client);
        $anonCart = $request->mapResponse($response);

        $request = CustomerLoginRequest::ofEmailAndPassword(
            $customer->getEmail(),
            $customerDraft->getPassword(),
            $anonCart->getId()
        )->setAnonymousCartSignInMode(CustomerLoginRequest::SIGN_IN_MODE_NEW);
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $loggedInCart = $result->getCart();

        $request = CartDeleteRequest::ofIdAndVersion($loggedInCart->getId(), $loggedInCart->getVersion());
        $request->executeWithClient($client);

        $this->assertNotSame($customerCart->getId(), $loggedInCart->getId());
        $this->assertSame($anonCart->getId(), $loggedInCart->getId());
        $this->assertSame($customer->getId(), $loggedInCart->getCustomerId());
        $this->assertSame(CartState::ACTIVE, $loggedInCart->getCartState());
    }

    public function testCartMergeOnLogin()
    {
        $client = $this->getClient();

        $customerDraft = $this->getCustomerDraft();
        $customer = $this->createCustomer($customerDraft);

        $customerCartDraft = $this->getCartDraft();
        $customerCartDraft->setCustomerId($customer->getId());
        $customerCart = $this->getCart($customerCartDraft);

        $anonCartDraft = $this->getCartDraft();
        $request = CartCreateRequest::ofDraft($anonCartDraft);
        $response = $request->executeWithClient($client);
        $anonCart = $request->mapResponse($response);

        $request = CustomerLoginRequest::ofEmailAndPassword(
            $customer->getEmail(),
            $customerDraft->getPassword(),
            $anonCart->getId()
        )->setAnonymousCartSignInMode(CustomerLoginRequest::SIGN_IN_MODE_MERGE);
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $loggedInCart = $result->getCart();

        $request = CartByIdGetRequest::ofId($anonCart->getId());
        $response = $request->executeWithClient($client);
        $anonCart = $request->mapResponse($response);

        $request = CartDeleteRequest::ofIdAndVersion($anonCart->getId(), $anonCart->getVersion());
        $response = $request->executeWithClient($client);
        $anonCart = $request->mapResponse($response);

        $this->assertNotSame($anonCart->getId(), $loggedInCart->getId());
        $this->assertSame($customerCart->getId(), $loggedInCart->getId());
        $this->assertSame(CartState::MERGED, $anonCart->getCartState());
        $this->assertSame($customer->getId(), $loggedInCart->getCustomerId());
    }
}
