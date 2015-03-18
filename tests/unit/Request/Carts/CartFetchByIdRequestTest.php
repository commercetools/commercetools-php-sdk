<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\RequestTestCase;

class CartFetchByIdRequestTest extends RequestTestCase
{
    const CART_FETCH_BY_ID_REQUEST = '\Sphere\Core\Request\Carts\CartFetchByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CART_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CART_FETCH_BY_ID_REQUEST, ['id']);
        $this->assertNull($result);
    }
}
