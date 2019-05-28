<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\ProductType;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeByKeyGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest;

class ProductTypeQueryRequestTest extends ApiTestCase
{
    /**
     * @return ProductTypeDraft
     */
    protected function getDraft()
    {
        $draft = ProductTypeDraft::ofNameAndDescription(
            'test-' . $this->getTestRun() . '-name',
            'test-' . $this->getTestRun() . '-description'
        );
        $draft->setKey('key-' . $this->getTestRun());

        return $draft;
    }

    protected function createProductType(ProductTypeDraft $draft)
    {
        $request = ProductTypeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $productType = $request->mapResponse($response);
        $this->cleanupRequests[] = ProductTypeDeleteRequest::ofIdAndVersion(
            $productType->getId(),
            $productType->getVersion()
        );

        return $productType;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $productType = $this->createProductType($draft);

        $request = ProductTypeQueryRequest::of()->where('name="' . $draft->getName() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(ProductType::class, $result->getAt(0));
        $this->assertSame($productType->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $productType = $this->createProductType($draft);

        $request = ProductTypeByIdGetRequest::ofId($productType->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertSame($productType->getId(), $result->getId());
    }

    public function testGetByKey()
    {
        $draft = $this->getDraft();
        $productType = $this->createProductType($draft);

        $request = ProductTypeByKeyGetRequest::ofKey($productType->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertSame($productType->getId(), $result->getId());
    }
}
