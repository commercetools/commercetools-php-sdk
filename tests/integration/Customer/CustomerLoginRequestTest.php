<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Customer;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Customers\CustomerByTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordChangeRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordResetRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;

class CustomerLoginRequestTest extends ApiTestCase
{
    /**
     * @return CustomerDraft
     */
    protected function getDraft($name)
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'test-' . $this->getTestRun() . '-email',
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

    public function testLoginFailure()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $request = CustomerLoginRequest::ofEmailAndPassword($customer->getEmail(), $this->getTestRun());
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
}
