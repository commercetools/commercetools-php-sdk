<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Client\HttpMethod;
use Sphere\Core\RequestTestCase;

class ProductsSearchRequestTest extends RequestTestCase
{
    const PRODUCT_SEARCH_REQUEST = '\Sphere\Core\Request\Products\ProductsSearchRequest';

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(static::PRODUCT_SEARCH_REQUEST, [], $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_SEARCH_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
    }

    public function testHttpRequestMethod()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame(HttpMethod::GET, $httpRequest->getHttpMethod());
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/search', $httpRequest->getPath());
    }

    public function testHttpRequestObject()
    {
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $httpRequest = $request->httpRequest();

        $this->assertNull($httpRequest->getBody());
    }

    public function testBuildResponse()
    {
        $guzzleResponse = $this->getMock('\GuzzleHttp\Message\Response', [], [], '', false);
        $request = $this->getRequest(static::PRODUCT_SEARCH_REQUEST);
        $response = $request->buildResponse($guzzleResponse);

        $this->assertInstanceOf('\Sphere\Core\Response\PagedQueryResponse', $response);
    }
}
