<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class ProductProjectionFetchBySkuRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST = '\Sphere\Core\Request\Products\ProductProjectionFetchBySkuRequest';

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(ProductProjectionFetchBySkuRequest::ofSku('sku'), $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionFetchBySkuRequest::ofSku('sku'));
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = ProductProjectionFetchBySkuRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getMethod());
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionFetchBySkuRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=masterVariant%28sku%3D%22sku%22%29+or+variants%28sku%3D%22sku%22%29',
            (string)$httpRequest->getUri()
        );
    }

    public function testHttpRequestObject()
    {
        $request = ProductProjectionFetchBySkuRequest::ofSku('sku');
        $httpRequest = $request->httpRequest();

        $this->assertEmpty((string)$httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Psr7\Response', [], [], '', false);
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
