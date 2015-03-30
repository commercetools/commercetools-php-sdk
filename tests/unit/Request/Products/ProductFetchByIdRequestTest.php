<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\RequestTestCase;

/**
 * Class ProductFetchByIdRequestTest
 * @package Sphere\Core\Request\Products
 */
class ProductFetchByIdRequestTest extends RequestTestCase
{
    const PRODUCT_FETCH_BY_ID_REQUEST = '\Sphere\Core\Request\Products\ProductFetchByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::PRODUCT_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\Product', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }
}
