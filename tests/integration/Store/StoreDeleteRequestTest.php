<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Message\StoreCreatedMessage;
use Commercetools\Core\Model\Message\StoreDeletedMessage;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Messages\MessageQueryRequest;

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

    public function testStoreCreatedMessage()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {

                $retries = 0;
                do {
                    $retries++;
                    sleep(1);
                    $request = MessageQueryRequest::of()
                        ->where('type = "StoreCreated"')
                        ->where('resource(id = "' . $store->getId() . '")');
                    $response = $this->execute($client, $request);
                    $result = $request->mapFromResponse($response);
                } while (is_null($result) && $retries <= 9);

                /**
                 * @var StoreCreatedMessage $message
                 */
                $message = $result->current();

                $this->assertInstanceOf(StoreCreatedMessage::class, $message);
                $this->assertSame($store->getId(), $message->getResource()->getId());
            }
        );
    }

    public function testStoreDeletedMessage()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                $request = RequestBuilder::of()->stores()->delete($store);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Store::class, $result);

                $retries = 0;
                do {
                    $retries++;
                    sleep(1);
                    $request = MessageQueryRequest::of()
                        ->where('type = "StoreDeleted"')
                        ->where('resource(id = "' . $store->getId() . '")');
                    $response = $this->execute($client, $request);
                    $result = $request->mapFromResponse($response);
                } while (is_null($result) && $retries <= 9);

                /**
                 * @var StoreDeletedMessage $message
                 */
                $message = $result->current();

                $this->assertInstanceOf(StoreDeletedMessage::class, $message);
                $this->assertSame($store->getId(), $message->getResource()->getId());
            }
        );
    }
}
