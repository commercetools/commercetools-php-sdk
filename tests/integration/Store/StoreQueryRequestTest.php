<?php
/**
 */


namespace Commercetools\Core\Store;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Stores\StoreByIdGetRequest;
use Commercetools\Core\Request\Stores\StoreByKeyGetRequest;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Request\Stores\StoreDeleteRequest;
use Commercetools\Core\Request\Stores\StoreQueryRequest;

class StoreQueryRequestTest extends ApiTestCase
{
    /**
     * @return StoreDraft
     */
    protected function getDraft()
    {
        return $this->getStoreDraft();
    }

    protected function createStore(StoreDraft $draft)
    {
        $request = StoreCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $store = $request->mapResponse($response);

        $this->cleanupRequests[] = StoreDeleteRequest::ofIdAndVersion(
            $store->getId(),
            $store->getVersion()
        );

        return $store;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $store = $this->createStore($draft);

        $request = StoreQueryRequest::of()->where('name(en="' . $draft->getName()->en . '")');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Store::class, $result->getAt(0));
        $this->assertSame($store->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $store = $this->createStore($draft);

        $request = StoreByIdGetRequest::ofId($store->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Store::class, $result);
        $this->assertSame($store->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $store = $this->createStore($draft);

        $request = StoreByKeyGetRequest::ofKey($store->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Store::class, $result);
        $this->assertSame($store->getId(), $result->getId());
        $this->assertSame($store->getKey(), $result->getKey());
    }
}
