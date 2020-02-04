<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CustomerGroup;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupChangeNameAction;
use Commercetools\Core\Request\CustomerGroups\Command\CustomerGroupSetKeyAction;

class CustomerGroupUpdateRequestTest extends ApiTestCase
{
    public function testChangeName()
    {
        $client = $this->getApiClient();

        CustomerGroupFixture::withCustomerGroup(
            $client,
            function (CustomerGroup $customerGroup) use ($client) {
                $name = 'new name-' . CustomerGroupFixture::uniqueCustomerGroupString();

                $request = RequestBuilder::of()->customerGroups()->update($customerGroup)
                    ->addAction(CustomerGroupChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomerGroup::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($customerGroup->getVersion(), $result->getVersion());
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        CustomerGroupFixture::withCustomerGroup(
            $client,
            function (CustomerGroup $customerGroup) use ($client) {
                $key = 'new-key-' . CustomerGroupFixture::uniqueCustomerGroupString();

                $request = RequestBuilder::of()->customerGroups()->update($customerGroup)
                    ->addAction(CustomerGroupSetKeyAction::of()->setKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomerGroup::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($customerGroup->getVersion(), $result->getVersion());
            }
        );
    }
}
