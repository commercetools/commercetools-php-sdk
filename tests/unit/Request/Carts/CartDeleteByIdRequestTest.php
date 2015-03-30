<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\RequestTestCase;

class CartDeleteByIdRequestTest extends RequestTestCase
{
    const CART_DELETE_BY_ID_REQUEST = '\Sphere\Core\Request\Carts\CartDeleteByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CART_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CART_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
