<?php

namespace Commercetools\Core\IntegrationTests\ProductSelection;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductSelectionQueryRequestTest extends ApiTestCase
{
    public function testGetById()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withProductSelection(
            $client,
            function (ProductSelection $productSelection) use ($client) {
                $request = RequestBuilder::of()->productSelections()->getById($productSelection->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductSelection::class, $productSelection);
                $this->assertSame($productSelection->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withDraftProductSelection(
            $client,
            function (ProductSelectionDraft $draft) {
                return $draft->setKey('key-' . ProductSelectionFixture::uniqueProductSelectionString());
            },
            function (ProductSelection $productSelection) use ($client) {
                $request = RequestBuilder::of()->productSelections()->getByKey($productSelection->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(ProductSelection::class, $productSelection);
                $this->assertSame($productSelection->getId(), $result->getId());
                $this->assertSame($productSelection->getKey(), $result->getKey());
            }
        );
    }

    public function testOverpaging()
    {
        $client = $this->getApiClient();

        ProductSelectionFixture::withDraftProductSelection(
            $client,
            function (ProductSelectionDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'MyProductSelection'));
            },
            function (ProductSelection $productSelection) use ($client) {
                $request = RequestBuilder::of()->productSelections()->query()->offset(10000);
                $response = $this->execute($client, $request);
                $pageQueryResponse = new PagedQueryResponse($response, $request);

                $this->assertSame(10000, $pageQueryResponse->getOffset());
                $this->assertSame(0, $pageQueryResponse->getCount());
                $this->assertCount(0, $pageQueryResponse->toObject());
            }
        );
    }
}
