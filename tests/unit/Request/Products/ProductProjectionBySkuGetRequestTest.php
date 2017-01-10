<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\RequestTestCase;

class ProductProjectionBySkuGetRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_BY_SKU_GET_REQUEST =
        ProductProjectionBySkuGetRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(ProductProjectionBySkuGetRequest::ofSku('sku'), $data);
        $this->assertInstanceOf(ProductProjection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionBySkuGetRequest::ofSku('sku'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ProductProjectionBySkuGetRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionBySkuGetRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=masterVariant%28sku%3D%22sku%22%29+or+variants%28sku%3D%22sku%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ProductProjectionBySkuGetRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $mockBuilder = $this->getMockBuilder('\GuzzleHttp\Psr7\Response');
        $mockBuilder->disableOriginalConstructor();
        $guzzleResponse = $mockBuilder->getMock();

        $request = $this->getRequest(static::PRODUCT_PROJECTION_BY_SKU_GET_REQUEST, ['sku']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Commercetools\Core\Response\ResourceResponse', $response);
    }
}
