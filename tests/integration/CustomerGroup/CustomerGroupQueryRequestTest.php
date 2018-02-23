<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\CustomerGroup;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest;

class CustomerGroupQueryRequestTest extends ApiTestCase
{
    /**
     * @return CustomerGroupDraft
     */
    protected function getDraft()
    {
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $this->getTestRun() . '-group'
        );

        return $draft;
    }

    protected function createCustomerGroup(CustomerGroupDraft $draft)
    {
        $request = CustomerGroupCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $customerGroup = $request->mapResponse($response);

        $this->cleanupRequests[] = CustomerGroupDeleteRequest::ofIdAndVersion(
            $customerGroup->getId(),
            $customerGroup->getVersion()
        );

        return $customerGroup;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $customerGroup = $this->createCustomerGroup($draft);

        $request = CustomerGroupQueryRequest::of()->where('name="' . $draft->getGroupName() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(CustomerGroup::class, $result->getAt(0));
        $this->assertSame($customerGroup->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $customerGroup = $this->createCustomerGroup($draft);

        $request = CustomerGroupByIdGetRequest::ofId($customerGroup->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CustomerGroup::class, $customerGroup);
        $this->assertSame($customerGroup->getId(), $result->getId());

    }
}
