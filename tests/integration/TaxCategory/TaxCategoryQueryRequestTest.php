<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\TaxCategory;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;

class TaxCategoryQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use ($client) {
                $request = RequestBuilder::of()->taxCategories()->query()
                    ->where('name=:name', ['name' => $taxCategory->getName()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(TaxCategory::class, $result->current());
                $this->assertSame($taxCategory->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use ($client) {
                $request = RequestBuilder::of()->taxCategories()->getById($taxCategory->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $taxCategory);
                $this->assertSame($taxCategory->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setKey('set-key');
            },
            function (TaxCategory $taxCategory) use ($client) {
                $request = RequestBuilder::of()->taxCategories()->getByKey($taxCategory->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $taxCategory);
                $this->assertSame($taxCategory->getId(), $result->getId());
                $this->assertSame($taxCategory->getKey(), $result->getKey());
            }
        );
    }


    public function testDeleteByKey()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setKey($this->getTestRun());
            },
            function (TaxCategory $taxCategory) use ($client) {
                $request = RequestBuilder::of()->taxCategories()->deleteByKey($taxCategory);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($taxCategory->getId(), $result->getId());
            }
        );
    }
}
