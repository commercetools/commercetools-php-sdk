<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client;
use Commercetools\Core\Client\OAuth\Token;
use Commercetools\Core\Config;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Customer\CustomerToken;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
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
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $request = RequestBuilder::of()->customers()->login($customer->getEmail(), $password);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getCustomer()->getId());
            }
        );
    }

    public function testLoginSuccessLowerCased()
    {
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $email = strtolower($customer->getEmail());

                $this->assertNotSame($customer->getEmail(), $email);

                $request = RequestBuilder::of()->customers()->login($email, $password);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getCustomer()->getId());
            }
        );
    }

    public function testLoginFailure()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");

        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $request = RequestBuilder::of()->customers()
                    ->login($customer->getEmail(), CustomerFixture::uniqueCustomerString());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testLoginFailureLowercased()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");

        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $email = strtolower($customer->getEmail());

                $this->assertNotSame($customer->getEmail(), $email);

                $request = RequestBuilder::of()->customers()
                    ->login($email, CustomerFixture::uniqueCustomerString());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testChangePasswordSuccess()
    {
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $request = RequestBuilder::of()->customers()
                    ->changePassword($customer, $password, CustomerFixture::uniqueCustomerString());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());
            }
        );
    }

    public function testChangePasswordFailure()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCurrentPassword/");

        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $request = RequestBuilder::of()->customers()
                    ->changePassword($customer, CustomerFixture::uniqueCustomerString(), $password);
                $this->execute($client, $request);
            }
        );
    }

    public function testPasswordReset()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");

        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client, $password) {
                $request = RequestBuilder::of()->customers()
                    ->createResetPasswordToken($customer->getEmail());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $token = $result->getValue();
                $this->assertNotEmpty($token);

                $request = RequestBuilder::of()->customers()->getByPasswordToken($token);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());

                $newPassword = CustomerFixture::uniqueCustomerString();

                $request = RequestBuilder::of()->customers()
                    ->resetPassword($token, $newPassword);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());

                $request = RequestBuilder::of()->customers()
                    ->login($customer->getEmail(), $newPassword);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getCustomer()->getId());

                $request = RequestBuilder::of()->customers()
                    ->login($customer->getEmail(), $password);
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testPasswordResetWithTtlMinutes()
    {
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $request = RequestBuilder::of()->customers()
                    ->createResetPasswordToken($customer->getEmail())->setTtlMinutes(61);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomerToken::class, $result);

                $dateCreated = $result->getCreatedAt()->getDateTime();
                $dateExpires = $result->getExpiresAt()->getDateTime();
                $interval = $dateExpires->diff($dateCreated);

                $this->assertSame(1, (int)$interval->format('%h'));
            }
        );
    }

    public function testPasswordResetLowerCased()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");

        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $email = strtolower($customer->getEmail());

                $this->assertNotSame($customer->getEmail(), $email);

                $request = RequestBuilder::of()->customers()
                    ->createResetPasswordToken($email);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $token = $result->getValue();
                $this->assertNotEmpty($token);

                $request = RequestBuilder::of()->customers()
                    ->getByPasswordToken($token);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());

                $newPassword = CustomerFixture::uniqueCustomerString();

                $request = RequestBuilder::of()->customers()
                    ->resetPassword($token, $newPassword);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());

                $request = RequestBuilder::of()->customers()
                    ->login($customer->getEmail(), $newPassword);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getCustomer()->getId());

                $request = RequestBuilder::of()->customers()
                    ->login($customer->getEmail(), $password);
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testVerifyEmail()
    {
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer) use ($client, $password) {
                $this->assertFalse($customer->getIsEmailVerified());

                $request = RequestBuilder::of()->customers()
                    ->createEmailVerificationToken($customer, 15);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $token = $result->getValue();
                $this->assertNotEmpty($token);

                $request = RequestBuilder::of()->customers()
                    ->getByEmailToken($token);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getId(), $result->getId());

                $request = RequestBuilder::of()->customers()
                    ->confirmEmail($token);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertTrue($result->getIsEmailVerified());
            }
        );
    }

    public function testDuplicateLowerCased()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/DuplicateField/");

        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) use ($password) {
                return $draft->setPassword($password);
            },
            function (Customer $customer1) use ($client, $password) {
                CustomerFixture::withDraftCustomer(
                    $client,
                    function (CustomerDraft $draft) use ($password, $customer1) {
                        return $draft->setPassword($password)->setEmail($customer1->getEmail())
                            ->setFirstName($customer1->getFirstName())->setLastName($customer1->getLastName());
                    },
                    function (Customer $customer2) use ($client, $password) {
                    }
                );
            }
        );
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

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame(Config::GRANT_TYPE_PASSWORD, $config->getGrantType());
        $this->assertNotEmpty($config->getRefreshToken());

        $refreshToken = $token->getRefreshToken();
        $this->assertNotEmpty($refreshToken);

        $cacheToken = $client->getOauthManager()->getToken();
        $this->assertSame($cacheToken->getToken(), $token->getToken());

        $forceRefreshToken = $client->getOauthManager()->refreshToken();
        $this->assertNotSame($token->getToken(), $forceRefreshToken->getToken());
    }
//todo migrate Cart first
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
//todo migrate Cart first
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
//todo migrate Cart first
    public function testCartUpdateProductDataOnLogin()
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

        $request = CustomerLoginRequest::ofEmailPasswordAndUpdateProductData(
            $customer->getEmail(),
            $customerDraft->getPassword(),
            true,
            $anonCart->getId()
        )->setAnonymousCartSignInMode(CustomerLoginRequest::SIGN_IN_MODE_MERGE);
        $body = json_decode((string)$request->httpRequest()->getBody(), true);
        $this->assertTrue($body['updateProductData']);
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

    public function testInStorePasswordReset()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageMatches("/InvalidCredentials/");

        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client, $password) {
                CustomerFixture::withDraftCustomer(
                    $client,
                    function (CustomerDraft $draft) use ($password) {
                        return $draft->setPassword($password);
                    },
                    function (Customer $customer) use ($client, $store, $password) {
                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->createResetPasswordToken($customer->getEmail())
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $token = $result->getValue();
                        $this->assertNotEmpty($token);

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->getByPasswordToken($token)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($customer->getId(), $result->getId());

                        $newPassword = CustomerFixture::uniqueCustomerString();

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->resetPassword($token, $newPassword)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($customer->getId(), $result->getId());

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->login($customer->getEmail(), $newPassword)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($customer->getId(), $result->getCustomer()->getId());

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->login($customer->getEmail(), $password)
                        );
                        $response = $this->execute($client, $request);
                        $request->mapFromResponse($response);
                    }
                );
            }
        );
    }

    public function testInStoreVerifyEmail()
    {
        $client = $this->getApiClient();
        $password = 'test-' . CustomerFixture::uniqueCustomerString() . '-password';

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client, $password) {
                CustomerFixture::withDraftCustomer(
                    $client,
                    function (CustomerDraft $draft) use ($password) {
                        return $draft->setPassword($password);
                    },
                    function (Customer $customer) use ($client, $store, $password) {
                        $this->assertFalse($customer->getIsEmailVerified());

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->createEmailVerificationToken($customer, 15)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $token = $result->getValue();
                        $this->assertNotEmpty($token);

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->getByEmailToken($token)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($customer->getId(), $result->getId());

                        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                            $store->getKey(),
                            RequestBuilder::of()->customers()->confirmEmail($token)
                        );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertTrue($result->getIsEmailVerified());
                    }
                );
            }
        );
    }
}
