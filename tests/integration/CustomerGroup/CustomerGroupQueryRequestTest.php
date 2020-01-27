<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CustomerGroup;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;

class CustomerGroupQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        CustomerGroupFixture::withCustomerGroup(
            $client,
            function (CustomerGroup $customerGroup) use ($client) {
                $request = RequestBuilder::of()->customerGroups()->query()
                    ->where('name=:name', ['name' => $customerGroup->getName()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(CustomerGroup::class, $result->current());
                $this->assertSame($customerGroup->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        CustomerGroupFixture::withCustomerGroup(
            $client,
            function (CustomerGroup $customerGroup) use ($client) {
                $request = RequestBuilder::of()->customerGroups()->getById($customerGroup->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomerGroup::class, $customerGroup);
                $this->assertSame($customerGroup->getId(), $result->getId());
            }
        );
    }
}
