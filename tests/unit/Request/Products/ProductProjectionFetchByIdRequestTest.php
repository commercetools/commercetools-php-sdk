<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\RequestTestCase;

/**
 * Class ProductProjectionFetchByIdRequestTest
 * @package Sphere\Core\Request\Products
 */
class ProductProjectionFetchByIdRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_FETCH_BY_ID_REQUEST = '\Sphere\Core\Request\Products\ProductProjectionFetchByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(ProductProjectionFetchByIdRequest::ofId('id'));
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionFetchByIdRequest::ofId('id'));
        $this->assertNull($result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionFetchByIdRequest::ofId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('/product-projections/id', (string)$httpRequest->getUri());
    }
}
