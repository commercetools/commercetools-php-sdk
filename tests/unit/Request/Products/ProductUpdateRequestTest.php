<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\RequestTestCase;

class ProductUpdateRequestTest extends RequestTestCase
{
    const PRODUCT_UPDATE_REQUEST = '\Sphere\Core\Request\Products\ProductUpdateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::PRODUCT_UPDATE_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\Product', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_UPDATE_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
