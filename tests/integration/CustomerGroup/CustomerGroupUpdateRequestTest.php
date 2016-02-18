<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\CustomerGroup;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction;

class CustomerGroupUpdateRequestTest extends ApiTestCase
{
    /**
     * @param $name
     * @return CustomerGroupDraft
     */
    protected function getDraft($name)
    {
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $this->getTestRun() . '-' . $name
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

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $customerGroup = $this->createCustomerGroup($draft);

        $name = $this->getTestRun() . '-new name';
        $request = CustomerGroupUpdateRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion())
            ->addAction(CustomerGroupChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\CustomerGroup\CustomerGroup', $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($customerGroup->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\CustomerGroup\CustomerGroup', $result);
    }
}
