<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Customer;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;

class CustomerQueryRequestTest extends ApiTestCase
{
    /**
     * @return CustomerDraft
     */
    protected function getDraft()
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'test-' . $this->getTestRun() . '-email',
            'test-' . $this->getTestRun() . '-firstName',
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

        $this->cleanupRequests[] = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        return $result->getCustomer();
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $customer = $this->createCustomer($draft);

        $request = CustomerQueryRequest::of()->where('email="' . $draft->getEmail() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);


        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Customer\Customer', $result->getAt(0));
        $this->assertSame($customer->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $customer = $this->createCustomer($draft);

        $request = CustomerByIdGetRequest::ofId($customer->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Customer\Customer', $customer);
        $this->assertSame($customer->getId(), $result->getId());

    }
}
