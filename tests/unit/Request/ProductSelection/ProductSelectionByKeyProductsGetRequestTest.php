<?php

namespace Commercetools\Core\Request\ProductSelection;

use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Request\ProductSelections\ProductSelectionByKeyProductsGetRequest;
use Commercetools\Core\RequestTestCase;
use Commercetools\Core\Response\ResourceResponse;

class ProductSelectionByKeyProductsGetRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_BY_KEY_PRODUCTS_GET_REQUEST = ProductSelectionByKeyProductsGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ProductSelectionByKeyProductsGetRequest::ofKey('key'));
        $this->assertInstanceOf(ProductSelection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionByKeyProductsGetRequest::ofKey('key'));
        $this->assertNull($result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductSelectionByKeyProductsGetRequest::ofKey('key');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-selections/key=key/products', (string)$httpRequest->getUri());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = ProductSelectionByKeyProductsGetRequest::ofKey('key');
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf(ResourceResponse::class, $response);
    }
}
