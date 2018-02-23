<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Me;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ResourceNotFoundError;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;
use Commercetools\Core\Request\Me\MeDeleteRequest;
use Commercetools\Core\Request\Me\MeEmailConfirmRequest;
use Commercetools\Core\Request\Me\MeGetRequest;
use Commercetools\Core\Request\Me\MeLoginRequest;
use Commercetools\Core\Request\Me\MePasswordChangeRequest;
use Commercetools\Core\Request\Me\MePasswordResetRequest;
use Monolog\Handler\TestHandler;
use Monolog\Logger;

class MeRequestTest extends ApiTestCase
{
    public function tearDown()
    {
        parent::tearDown();
        $this->getCache()->clear();
    }


    public function testGetMe()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig('manage_my_profile');
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

        $request = MeGetRequest::of();
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
    }

    /**
     * @expectedException \Commercetools\Core\Error\BadRequestException
     */
    public function testPasswordChangeRevokeToken()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig('manage_my_profile');
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

        $request = MePasswordChangeRequest::ofVersionAndPasswords(
            $customer->getVersion(),
            $customerDraft->getPassword(),
            'new-' . $this->getTestRun()
        );
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
        $this->customer = $result;

        $request = MeGetRequest::of();
        $request->executeWithClient($client);
    }

    public function testPasswordChange()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig('manage_my_profile');
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

        $newPassword = 'new-' . $this->getTestRun();
        $request = MePasswordChangeRequest::ofVersionAndPasswords(
            $customer->getVersion(),
            $customerDraft->getPassword(),
            $newPassword
        );
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
        $this->customer = $result;

        $config->setPassword($newPassword);

        $request = MeGetRequest::of();
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
    }

    public function testPasswordReset()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $request = CustomerPasswordTokenRequest::ofEmail(
            $customer->getEmail()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $token = $result->getValue();
        $this->assertNotEmpty($token);

        $config = $this->getClientConfig(['manage_my_profile', 'create_anonymous_token']);
        $config->setGrantType(Config::GRANT_TYPE_ANONYMOUS);

        $handler = new TestHandler();
        $logger = new Logger('testOauth');
        $logger->pushHandler($handler);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()])->setLogger($logger);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $newPassword = 'new-' . $this->getTestRun();
        $request = MePasswordResetRequest::ofTokenAndPassword(
            $token,
            $newPassword
        );
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('anonymous/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
        $this->customer = $result;

        $config = $this->getClientConfig(['manage_my_profile']);
        $config->setGrantType(Config::GRANT_TYPE_PASSWORD)
            ->setUsername($customer->getEmail())
            ->setPassword($newPassword)
        ;

        $handler = new TestHandler();
        $logger = new Logger('testOauth');
        $logger->pushHandler($handler);

        $client = Client::ofConfigCacheAndLogger($config, $this->getCache(), $this->getLogger());
        $client->getOauthManager()->getHttpClient(['verify' => $this->getVerifySSL()])->setLogger($logger);
        $client->getHttpClient(['verify' => $this->getVerifySSL()]);

        $request = MeGetRequest::of();
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);

        $this->assertContains('customers/token', current($handler->getRecords())['message']);
        $this->assertSame($customer->getId(), $result->getId());
    }

    public function testVerifyEmail()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

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

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeEmailConfirmRequest::ofToken(
            $token
        );
        $response = $request->executeWithClient($client);
        $result = $request->mapResponse($response);
        $this->customer = $result;

        $this->assertTrue($result->getIsEmailVerified());
    }

    public function testMeDelete()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeDeleteRequest::ofVersion($customer->getVersion());
        $response = $request->executeWithClient($client);
        $this->customer = null;

        $this->assertFalse($response->isError());

        $request = CustomerByIdGetRequest::ofId($customer->getId());
        $response = $request->executeWithClient($this->getClient());
        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            ResourceNotFoundError::class,
            $response->getErrors()->getByCode(ResourceNotFoundError::CODE)
        );
    }

    public function testLoginSuccess()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeLoginRequest::ofEmailAndPassword($customer->getEmail(), $customerDraft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testLoginSuccessUpdateProductData()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeLoginRequest::ofEmailPasswordAndUpdateProductData(
            $customer->getEmail(),
            $customerDraft->getPassword(),
            true
        );
        $body = json_decode((string)$request->httpRequest()->getBody(), true);
        $this->assertTrue($body['updateProductData']);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testLoginSuccessLowerCased()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);
        $email = strtolower($customer->getEmail());
        $this->assertNotSame($customer->getEmail(), $email);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeLoginRequest::ofEmailAndPassword($email, $customerDraft->getPassword());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertFalse($response->isError());
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
    }

    public function testLoginFailure()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeLoginRequest::ofEmailAndPassword($customer->getEmail(), $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testLoginFailureLowercased()
    {
        $customerDraft = $this->getCustomerDraft();
        $customer = $this->getCustomer($customerDraft);
        $email = strtolower($customer->getEmail());
        $this->assertNotSame($customer->getEmail(), $email);

        $config = $this->getClientConfig(['manage_my_profile']);
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

        $request = MeLoginRequest::ofEmailAndPassword($email, $this->getTestRun());
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }
}
