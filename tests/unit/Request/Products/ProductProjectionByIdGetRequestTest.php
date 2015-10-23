<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\RequestTestCase;

/**
 * Class ProductProjectionByIdGetRequestTest
 * @package Commercetools\Core\Request\Products
 */
class ProductProjectionByIdGetRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTION_BY_ID_GET_REQUEST = '\Commercetools\Core\Request\Products\ProductProjectionByIdGetRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(ProductProjectionByIdGetRequest::ofId('id'));
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $result);
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
