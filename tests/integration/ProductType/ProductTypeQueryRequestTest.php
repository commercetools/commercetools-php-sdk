<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\ProductType;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest;
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

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $productType = $this->createProductType($draft);

        $result = $this->getClient()->execute(
            ProductTypeQueryRequest::of()->where('name="' . $draft->getName() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $result->getAt(0));
        $this->assertSame($productType->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $productType = $this->createProductType($draft);

        $result = $this->getClient()->execute(ProductTypeByIdGetRequest::ofId($productType->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductType', $productType);
        $this->assertSame($productType->getId(), $result->getId());

    }
}
