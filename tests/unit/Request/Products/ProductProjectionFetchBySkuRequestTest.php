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
        $result = $this->mapQueryResult(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku'], $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $this->assertNull($result);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $httpRequest = $request->httpRequest();

        $this->assertSame(
            'product-projections?limit=1&where=masterVariant%28sku%3D%22sku%22%29+or+variants%28sku%3D%22sku%22%29',
            $httpRequest->getPath()
        );
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_SKU_REQUEST, ['sku']);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\SingleResourceResponse', $response);
    }
}
