<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CustomObject;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Error\ConcurrentModificationException;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;

class CustomObjectQueryRequestTest extends ApiTestCase
{
    public function testCustomObjectWithVersion()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $customObject) use ($client) {
                $request = RequestBuilder::of()->customObjects()->create($customObject);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($customObject->getVersion(), $result->getVersion());
            }
        );
    }

    public function testCustomObjectWithVersionConflict()
    {
        $client = $this->getApiClient();
        $this->expectException(ConcurrentModificationException::class);
        $this->expectExceptionCode(409);

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $customObject) use ($client) {
                $request = RequestBuilder::of()->customObjects()->create($customObject);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($customObject->getVersion(), $result->getVersion());

                $request = CustomObjectCreateRequest::ofObject($customObject);
                $response = $client->execute($request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testCustomObjectDraftWithVersionConflict()
    {
        $client = $this->getApiClient();
        $this->expectException(ConcurrentModificationException::class);
        $this->expectExceptionCode(409);

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $customObject) use ($client) {
                $request = RequestBuilder::of()->customObjects()->create($customObject);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertNotSame($customObject->getVersion(), $result->getVersion());

                $request = CustomObjectCreateRequest::ofObject($customObject);
                $response = $client->execute($request);
                $request->mapFromResponse($response);
            }
        );
    }

    public function testValidTypes()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $customObject) use ($client) {
                $this->assertInstanceOf(
                    CustomObjectCreateRequest::class,
                    RequestBuilder::of()->customObjects()->create($customObject)
                );
                $this->assertInstanceOf(
                    CustomObjectCreateRequest::class,
                    RequestBuilder::of()->customObjects()->create($customObject)
                );
            }
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidType()
    {
        $client = $this->getApiClient();

        CustomObjectFixture::withCustomObject(
            $client,
            function (CustomObject $customObject) use ($client) {
                RequestBuilder::of()->customObjects()->create(new \stdClass());
            }
        );
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
