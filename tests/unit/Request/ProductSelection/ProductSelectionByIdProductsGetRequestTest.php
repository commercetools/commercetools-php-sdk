<?php

namespace Commercetools\Core\Request\ProductSelection;

use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByIdProductsGetRequest;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class ProductSelectionByIdProductsGetRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_BY_ID_PRODUCTS_GET_REQUEST = ProductSelectionByIdProductsGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ProductSelectionByIdProductsGetRequest::ofId('id'));
        $this->assertInstanceOf(ProductSelection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionByIdProductsGetRequest::ofId('id'));
        $this->assertNull($result);
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

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
