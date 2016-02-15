<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
        /**
         * @var CustomerGroup $customerGroup
         */
        $response = $this->getClient()
            ->execute(CustomerGroupCreateRequest::ofDraft($draft));

        $customerGroup = $response->toObject();

        $this->cleanupRequests[] = CustomerGroupDeleteRequest::ofIdAndVersion(
            $customerGroup->getId(),
            $customerGroup->getVersion()
        );

        return $customerGroup;
    }

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $customerGroup = $this->createCustomerGroup($draft);

        $result = $this->getClient()->execute(
            CustomerGroupQueryRequest::of()->where('name="' . $draft->getGroupName() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\CustomerGroup\CustomerGroup', $result->getAt(0));
        $this->assertSame($customerGroup->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $customerGroup = $this->createCustomerGroup($draft);

        $result = $this->getClient()->execute(CustomerGroupByIdGetRequest::ofId($customerGroup->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\CustomerGroup\CustomerGroup', $customerGroup);
        $this->assertSame($customerGroup->getId(), $result->getId());

    }
}
