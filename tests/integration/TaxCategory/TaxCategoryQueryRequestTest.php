<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\TaxCategory;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByKeyGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteByKeyRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest;

class TaxCategoryQueryRequestTest extends ApiTestCase
{
    /**
     * @return TaxCategoryDraft
     */
    protected function getDraft()
    {
        $draft = TaxCategoryDraft::ofNameAndRates(
            'test-' . $this->getTestRun() . '-name',
            TaxRateCollection::of()->add(
                TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                    ->setAmount(0.2)
                    ->setIncludedInPrice(true)
                    ->setCountry('DE')
                    ->setState($this->getRegion())
            )
        );

        return $draft;
    }

    protected function createTaxCategory(TaxCategoryDraft $draft)
    {
        $request = TaxCategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $taxCategory = $request->mapResponse($response);

        $this->cleanupRequests[] = TaxCategoryDeleteRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        );

        return $taxCategory;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $taxCategory = $this->createTaxCategory($draft);

        $request = TaxCategoryQueryRequest::of()->where('name="' . $draft->getName() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(TaxCategory::class, $result->getAt(0));
        $this->assertSame($taxCategory->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $taxCategory = $this->createTaxCategory($draft);

        $request = TaxCategoryByIdGetRequest::ofId($taxCategory->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(TaxCategory::class, $taxCategory);
        $this->assertSame($taxCategory->getId(), $result->getId());

    }

    public function testGetByKey()
    {
        $draft = $this->getDraft()->setKey($this->getTestRun());
        $taxCategory = $this->createTaxCategory($draft);

        $request = TaxCategoryByKeyGetRequest::ofKey($taxCategory->getKey());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(TaxCategory::class, $taxCategory);
        $this->assertSame($taxCategory->getId(), $result->getId());
    }


    public function testDeleteByKey()
    {
        $draft = $this->getDraft()->setKey($this->getTestRun());
        $taxCategory = $this->createTaxCategory($draft);

        $request = TaxCategoryDeleteByKeyRequest::ofKeyAndVersion(
            $taxCategory->getKey(),
            $taxCategory->getVersion()
        );
        $result = $this->getClient()->execute($request);
        $response = $request->mapFromResponse($result);

        $this->assertSame($taxCategory->getId(), $response->getId());
    }
}
