<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\RequestTestCase;

class ProductProjectionQueryRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTIONS_QUERY_REQUEST = '\Sphere\Core\Request\Products\ProductProjectionQueryRequest';

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(static::PRODUCT_PROJECTIONS_QUERY_REQUEST, [], $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_PROJECTIONS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjectionCollection', $result);
    }
}
