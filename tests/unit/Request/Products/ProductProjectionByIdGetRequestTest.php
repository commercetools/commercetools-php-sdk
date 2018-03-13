<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\RequestTestCase;

/**
 * Class ProductProjectionByIdGetRequestTest
 * @package Commercetools\Core\Request\Products
 */
class ProductProjectionByIdGetRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_BY_ID_GET_REQUEST = ProductProjectionByIdGetRequest::class;

    public function testMapResult()
    {
        $result = $this->mapResult(ProductProjectionByIdGetRequest::ofId('id'));
        $this->assertInstanceOf(ProductProjection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionByIdGetRequest::ofId('id'));
        $this->assertNull($result);
    }

    public function testHttpRequestPath()
    {
        $request = ProductProjectionByIdGetRequest::ofId('id');
        $httpRequest = $request->httpRequest();

        $this->assertSame('product-projections/id', (string)$httpRequest->getUri());
    }
}
