<?php

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\ProductSelection\AssignedProductReference;
use Commercetools\Core\Model\ProductSelection\AssignedProductSelection;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductByIdProductSelectionsGetRequestTest extends RequestTestCase
{
    const PRODUCT_BY_ID_PRODUCT_SELECTIONS_GET_REQUEST = ProductByIdProductSelectionsGetRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'id'],
                ['id' => 'id'],
                ['id' => 'id'],
            ]
        ];
        $result = $this->mapQueryResult(ProductByIdProductSelectionsGetRequest::ofId('id'), [], $data);
        $this->assertInstanceOf(AssignedProductSelection::class, $result);
        $this->assertCount(3, $result->toArray());
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductByIdProductSelectionsGetRequest::ofId('id'));
        $this->assertInstanceOf(AssignedProductSelection::class, $result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductByIdProductSelectionsGetRequest::ofId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('products/id/product-selections', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductByIdProductSelectionsGetRequest::ofId('id');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
