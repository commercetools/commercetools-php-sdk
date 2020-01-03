<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\CustomObject;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Error\ConcurrentModificationError;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Request\CustomObjects\CustomObjectByIdGetRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectByKeyGetRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteByKeyRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectQueryRequest;

class CustomObjectQueryRequestTest extends ApiTestCase
{
    /**
     * @return CustomObjectDraft
     */
    protected function getDraft()
    {
        $draft = CustomObjectDraft::ofContainerKeyAndValue(
            'test-' . $this->getTestRun() . '-container',
            'test-' . $this->getTestRun() . '-key',
            'test-' . $this->getTestRun() . '-value'
        );

        return $draft;
    }

    protected function createCustomObject(CustomObjectDraft $draft)
    {
        $request = CustomObjectCreateRequest::ofObject($draft);
        $response = $request->executeWithClient($this->getClient());
        $customObject = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = CustomObjectDeleteRequest::ofIdAndVersion(
            $customObject->getId(),
            $customObject->getVersion()
        );

        return $customObject;
    }

    public function testCustomObjectWithVersion()
    {
        $draft = $this->getDraft();
        $customObject = $this->createCustomObject($draft);

        $request = CustomObjectCreateRequest::ofObject($customObject);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($customObject->getVersion(), $result->getVersion());
    }

    public function testCustomObjectWithVersionConflict()
    {
        $draft = $this->getDraft();
        $customObject = $this->createCustomObject($draft);

        $request = CustomObjectCreateRequest::ofObject($customObject);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($customObject->getVersion(), $result->getVersion());

        $request = CustomObjectCreateRequest::ofObject($customObject);
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            ConcurrentModificationError::class,
            $response->getErrors()->getByCode(ConcurrentModificationError::CODE)
        );
    }

    public function testCustomObjectDraftWithVersionConflict()
    {
        $draft = $this->getDraft();
        $customObject = $this->createCustomObject($draft);

        $request = CustomObjectCreateRequest::ofObject($draft);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($customObject->getVersion(), $result->getVersion());

        $draft->setVersion($customObject->getVersion());
        $request = CustomObjectCreateRequest::ofObject($draft);
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf(
            ConcurrentModificationError::class,
            $response->getErrors()->getByCode(ConcurrentModificationError::CODE)
        );
    }

    public function testValidTypes()
    {
        $this->assertInstanceOf(
            CustomObjectCreateRequest::class,
            CustomObjectCreateRequest::ofObject(CustomObject::of())
        );
        $this->assertInstanceOf(
            CustomObjectCreateRequest::class,
            CustomObjectCreateRequest::ofObject(CustomObjectDraft::of())
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidType()
    {
        CustomObjectCreateRequest::ofObject(new \stdClass());
    }

    public function testQuery()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $draft) use ($client) {
                $request = RequestBuilder::of()->customObjects()->query()
                    ->where('container=:container', ['container' => $draft->getContainer()])
                    ->where('key=:key', ['key' => $draft->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(CustomObject::class, $result->current());
                $this->assertSame($draft->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetByContainerAndKey()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $draft) use ($client) {
                $request = RequestBuilder::of()->customObjects()->getByContainerAndKey(
                    $draft->getContainer(),
                    $draft->getKey()
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomObject::class, $draft);
                $this->assertSame($draft->getId(), $result->getId());
                $this->assertSame($draft->getKey(), $result->getKey());
                $this->assertSame($draft->getContainer(), $result->getContainer());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $draft) use ($client) {
                $request = RequestBuilder::of()->customObjects()->getById($draft->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(CustomObject::class, $draft);
                $this->assertSame($draft->getId(), $result->getId());
            }
        );
    }

    public function testDeleteByKey()
    {
        $client = $this->getApiClient();

        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $draft) use ($client) {
                $request = RequestBuilder::of()->customObjects()->deleteByContainerAndKey($draft);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->customObjects()->getByContainerAndKey(
                    $result->getContainer(),
                    $result->getId()
                );
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
