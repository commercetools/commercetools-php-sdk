<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Type;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Types\TypeByIdGetRequest;
use Commercetools\Core\Request\Types\TypeByKeyGetRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Types\TypeQueryRequest;

class TypeQueryRequestTest extends ApiTestCase
{
    /**
     * @return TypeDraft
     */
    protected function getDraft()
    {
        $draft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
            'key-' . $this->getTestRun(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-name'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-description'),
            ['category']
        );

        return $draft;
    }

    protected function createType(TypeDraft $draft)
    {
        /**
         * @var Type $type
         */
        $request = TypeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());

        $type = $request->mapResponse($response);

        $this->cleanupRequests[] = TypeDeleteRequest::ofIdAndVersion(
            $type->getId(),
            $type->getVersion()
        );

        return $type;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $type = $this->createType($draft);

        $request = TypeQueryRequest::of()->where('key="' . $draft->getKey() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Type\Type', $result->getAt(0));
        $this->assertSame($type->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $type = $this->createType($draft);

        $request = TypeByIdGetRequest::ofId($type->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Type\Type', $type);
        $this->assertSame($type->getId(), $result->getId());

    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $productType = $this->createType($draft);

        $request = TypeByKeyGetRequest::ofKey($productType->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Type\Type', $productType);
        $this->assertSame($productType->getId(), $result->getId());

    }
}
