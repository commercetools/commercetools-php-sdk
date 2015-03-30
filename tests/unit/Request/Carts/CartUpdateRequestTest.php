<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\RequestTestCase;

class CartUpdateRequestTest extends RequestTestCase
{
    const CART_UPDATE_REQUEST = '\Sphere\Core\Request\Carts\CartUpdateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CART_UPDATE_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CART_UPDATE_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
