<?php
/**
 */

namespace Commercetools\Core\Store;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\Stores\Command\StoreSetNameAction;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Request\Stores\StoreDeleteByKeyRequest;
use Commercetools\Core\Request\Stores\StoreDeleteRequest;
use Commercetools\Core\Request\Stores\StoreUpdateByKeyRequest;
use Commercetools\Core\Request\Stores\StoreUpdateRequest;

class StoreUpdateRequestTest extends ApiTestCase
{
    private $storeDeleteRequests = [];

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteStore();
    }

    protected function createStore($draft)
    {
        $request = StoreCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $store = $request->mapResponse($response);

        $this->storeDeleteRequests[] = $this->deleteRequest = StoreDeleteRequest::ofIdAndVersion(
            $store->getId(),
            $store->getVersion()
        );

        return $store;
    }

    protected function deleteStore()
    {
        if (count($this->storeDeleteRequests) > 0) {
            foreach ($this->storeDeleteRequests as $request) {
                $this->getClient()->addBatchRequest($request);
            }
            $this->getClient()->executeBatch();
            $this->storeDeleteRequests = [];
        }
    }

    public function testUpdateName()
    {
        $store = $this->createStore($this->getStoreDraft('store-name'));

        $request = StoreUpdateRequest::ofIdAndVersion($store->getId(), $store->getVersion())
            ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', 'another-name')));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);

        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Store::class, $result);
        $this->assertSame($store->getId(), $result->getId());
        $this->assertSame('another-name', $result->getName()->en);
        $this->assertNotSame($store->getVersion(), $result->getVersion());
    }

    public function testUpdateAndDeleteByKey()
    {
        $store = $this->createStore($this->getStoreDraft('store-name'));

        $request = StoreUpdateByKeyRequest::ofKeyAndVersion($store->getKey(), $store->getVersion())
            ->addAction(StoreSetNameAction::ofName(LocalizedString::ofLangAndText('en', 'another-name')));
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);

        $this->assertInstanceOf(Store::class, $result);
        $this->assertSame($store->getId(), $result->getId());
        $this->assertSame('another-name', $result->getName()->en);
        $this->assertNotSame($store->getVersion(), $result->getVersion());

        $deleteRequest = StoreDeleteByKeyRequest::ofKeyAndVersion($result->getKey(), $result->getVersion());
        $deleteResponse = $deleteRequest->executeWithClient($this->getClient());
        $deleteResult = $deleteRequest->mapFromResponse($deleteResponse);

        $this->assertInstanceOf(Store::class, $deleteResult);
    }
}
