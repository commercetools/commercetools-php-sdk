<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Model\Cart\CartDraft;
use Sphere\Core\RequestTestCase;

class CartCreateRequestTest extends RequestTestCase
{
    const CART_CREATE_REQUEST = '\Sphere\Core\Request\Carts\CartCreateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::CART_CREATE_REQUEST, [CartDraft::ofCurrency('EUR')]);
        $this->assertInstanceOf('\Sphere\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::CART_CREATE_REQUEST, [CartDraft::ofCurrency('EUR')]);
        $this->assertNull($result);
    }
}
