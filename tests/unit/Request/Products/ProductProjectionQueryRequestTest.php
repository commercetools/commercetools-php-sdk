<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\RequestTestCase;

class ProductProjectionQueryRequestTest extends RequestTestCase
{
    const PRODUCT_PROJECTIONS_QUERY_REQUEST = ProductProjectionQueryRequest::class;

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(ProductProjectionQueryRequest::of(), [], $data);
        $this->assertInstanceOf(ProductProjectionCollection::class, $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductProjectionQueryRequest::of());
        $this->assertInstanceOf(ProductProjectionCollection::class, $result);
    }
}
