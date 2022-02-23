<?php

namespace Commercetools\Core\Request\ProductSelections;

use Commercetools\Core\Model\ProductSelection\AssignedProductReference;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductSelectionByIdProductsGetRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_BY_ID_PRODUCTS_GET_REQUEST = ProductSelectionByIdProductsGetRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'id'],
                ['id' => 'id'],
                ['id' => 'id'],
            ]
        ];
        $result = $this->mapQueryResult(ProductSelectionByIdProductsGetRequest::ofId('id'), [], $data);
        $this->assertInstanceOf(AssignedProductReference::class, $result);
        $this->assertCount(3, $result->toArray());
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionByIdProductsGetRequest::ofId('id'));
        $this->assertInstanceOf(AssignedProductReference::class, $result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductSelectionByIdProductsGetRequest::ofId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-selections/id/products', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductSelectionByIdProductsGetRequest::ofId('id');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
