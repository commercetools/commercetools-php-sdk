<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\CustomerGroup;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupSetKeyAction;
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

        $this->cleanupRequests[] = $this->deleteRequest = CustomerGroupDeleteRequest::ofIdAndVersion(
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

        $this->assertInstanceOf(CustomerGroup::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($customerGroup->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CustomerGroup::class, $result);
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $customerGroup = $this->createCustomerGroup($draft);

        $key = $this->getTestRun() . '-new-key';
        $request = CustomerGroupUpdateRequest::ofIdAndVersion($customerGroup->getId(), $customerGroup->getVersion())
            ->addAction(CustomerGroupSetKeyAction::of()->setKey($key))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(CustomerGroup::class, $result);
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($customerGroup->getVersion(), $result->getVersion());

        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(CustomerGroup::class, $result);
    }
}
