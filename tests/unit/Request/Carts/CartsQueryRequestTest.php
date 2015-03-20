<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\RequestTestCase;

class CartsQueryRequestTest extends RequestTestCase
{
    const CARTS_QUERY_REQUEST = '\Sphere\Core\Request\Carts\CartsQueryRequest';

    public function testMapResult()
    {
        $data = [
            'results' => [
                ['id' => 'value'],
                ['id' => 'value'],
                ['id' => 'value'],
            ]
        ];
        $result = $this->mapQueryResult(static::CARTS_QUERY_REQUEST, [], $data);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\CartCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CARTS_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\CartCollection', $result);
    }
}
