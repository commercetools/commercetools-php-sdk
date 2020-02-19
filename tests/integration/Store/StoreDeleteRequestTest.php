<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Store\Store;

class StoreDeleteRequestTest extends ApiTestCase
{
    public function testDeleteByKey()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $request = RequestBuilder::of()->stores()->deleteByKey($store);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($store->getId(), $result->getId());
                $this->assertInstanceOf(Store::class, $result);

                $request = RequestBuilder::of()->stores()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
