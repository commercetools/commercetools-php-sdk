<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\CustomObject;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
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

        $this->cleanupRequests[] = CustomObjectDeleteRequest::ofIdAndVersion(
            $customObject->getId(),
            $customObject->getVersion()
        );

        return $customObject;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $customObject = $this->createCustomObject($draft);

        $request = CustomObjectQueryRequest::of()->where(
            'container="' . $draft->getContainer() . '" and key="' . $draft->getKey() . '"'
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\CustomObject\CustomObject', $result->getAt(0));
        $this->assertSame($customObject->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $customObject = $this->createCustomObject($draft);

        $request = CustomObjectByKeyGetRequest::ofContainerAndKey(
            $customObject->getContainer(),
            $customObject->getKey()
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\CustomObject\CustomObject', $customObject);
        $this->assertSame($customObject->getId(), $result->getId());
    }

    public function testDeleteByKey()
    {
        $draft = $this->getDraft();

        $request = CustomObjectCreateRequest::ofObject($draft);
        $response = $request->executeWithClient($this->getClient());
        $customObject = $request->mapResponse($response);

        $deleteRequest = CustomObjectDeleteByKeyRequest::ofContainerAndKey(
            $customObject->getContainer(),
            $customObject->getKey()
        );
        $response = $deleteRequest->executeWithClient($this->getClient());
        $this->assertSame(200, $response->getStatusCode());
    }
}
