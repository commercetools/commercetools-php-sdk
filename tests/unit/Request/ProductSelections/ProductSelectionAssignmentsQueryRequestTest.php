<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\ProductSelection\ProductSelectionAssignment;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductSelectionAssignmentsQueryRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_BY_ID_PRODUCTS_GET_REQUEST = ProductSelectionAssignmentsQueryRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(ProductSelectionAssignmentsQueryRequest::of(), [], $data);
        $this->assertInstanceOf(ProductSelectionAssignment::class, $result);
        $this->assertCount(3, $result->toArray());
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionAssignmentsQueryRequest::of());
        $this->assertInstanceOf(ProductSelectionAssignment::class, $result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductSelectionAssignmentsQueryRequest::of();
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-selection-assignments', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductSelectionAssignmentsQueryRequest::of();
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
