<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\RequestTestCase;

class ProductsQueryRequestTest extends RequestTestCase
{
    const PRODUCTS_QUERY_REQUEST = '\Sphere\Core\Request\Products\ProductsQueryRequest';

    public function testMapResult()
    {
        $result = $this->mapQueryResult(static::PRODUCTS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCTS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductCollection', $result);
    }

    public function testExpand()
    {
        $request = $this->getRequest(static::PRODUCTS_QUERY_REQUEST);
        $request->expand('test');
        $httpRequest = $request->httpRequest();

        $this->assertSame('products?expand=test', $httpRequest->getPath());
    }
}
