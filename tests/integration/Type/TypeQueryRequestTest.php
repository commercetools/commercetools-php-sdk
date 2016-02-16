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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $type = $this->createType($draft);

        $result = $this->getClient()->execute(
            TypeQueryRequest::of()->where('key="' . $draft->getKey() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Type\Type', $result->getAt(0));
        $this->assertSame($type->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $type = $this->createType($draft);

        $result = $this->getClient()->execute(TypeByIdGetRequest::ofId($type->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Type\Type', $type);
        $this->assertSame($type->getId(), $result->getId());

    }
}
