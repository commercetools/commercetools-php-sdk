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
        $result = $this->mapResult(static::PRODUCT_PROJECTION_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_PROJECTION_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }

    public function testHttpRequestPath()
    {
        $request = $this->getRequest(static::PRODUCT_PROJECTION_FETCH_BY_ID_REQUEST, ['id']);
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/id', (string)$httpRequest->getUri());
    }
}
