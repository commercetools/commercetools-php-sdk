<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Store\Store;

class StoreQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $request = RequestBuilder::of()->stores()->query()
                    ->where('name(en=:name)', ['name' => $store->getName()->en]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Store::class, $result->current());
                $this->assertSame($store->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $request = RequestBuilder::of()->stores()->getById($store->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $request = RequestBuilder::of()->stores()->getByKey($store->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);
                $this->assertSame($store->getId(), $result->getId());
                $this->assertSame($store->getKey(), $result->getKey());
            }
        );
    }
}
