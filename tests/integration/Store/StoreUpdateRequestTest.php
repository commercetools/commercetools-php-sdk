<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Stores\Command\StoreSetNameAction;

class StoreUpdateRequestTest extends ApiTestCase
{
    public function testUpdateName()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $name = 'new-name';

                $request = RequestBuilder::of()->stores()->update($store)
                    ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($name, $result->getName()->en);
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        StoreFixture::withUpdateableStore(
            $client,
            function (Store $store) use ($client) {
                $name = 'new-name';

                $request = RequestBuilder::of()->stores()->updateByKey($store)
                    ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', $name)));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($name, $result->getName()->en);
                $this->assertNotSame($store->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
}
