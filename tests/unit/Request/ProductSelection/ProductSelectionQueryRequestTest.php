<?php

namespace Commercetools\Core\Request\ProductSelection;

use Commercetools\Core\Model\ProductSelection\ProductSelectionCollection;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;
use Commercetools\Core\Request\ProductSelections\ProductSelectionQueryRequest;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductSelectionQueryRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_QUERY_REQUEST = ProductSelectionQueryRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(ProductSelectionQueryRequest::of(), [], $data);
        $this->assertInstanceOf(ProductSelectionCollection::class, $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionQueryRequest::of());
        $this->assertInstanceOf(ProductSelectionCollection::class, $result);
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductSelectionQueryRequest::of();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
