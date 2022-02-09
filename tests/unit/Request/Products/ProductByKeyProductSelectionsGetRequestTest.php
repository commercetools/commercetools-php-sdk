<?php

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\ProductSelection\AssignedProductSelection;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\PagedQueryResponse;

class ProductByKeyProductSelectionsGetRequestTest extends RequestTestCase
{
    const PRODUCT_BY_KEY_PRODUCT_SELECTIONS_GET_REQUEST = ProductByKeyProductSelectionsGetRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['key' => 'key'],
                ['key' => 'key'],
                ['key' => 'key'],
            ]
        ];
        $result = $this->mapQueryResult(ProductByKeyProductSelectionsGetRequest::ofKey('key'), [], $data);
        $this->assertInstanceOf(AssignedProductSelection::class, $result);
        $this->assertCount(3, $result->toArray());
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductByKeyProductSelectionsGetRequest::ofKey('key'));
        $this->assertInstanceOf(AssignedProductSelection::class, $result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductByKeyProductSelectionsGetRequest::ofKey('key');
        $httpRequest = $request->httpRequest();

        $this->assertSame('products/key=key/product-selections', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductByKeyProductSelectionsGetRequest::ofKey('key');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(PagedQueryResponse::class, $response);
    }
}
