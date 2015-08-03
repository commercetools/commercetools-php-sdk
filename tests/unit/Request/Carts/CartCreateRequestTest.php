<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;


use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\RequestTestCase;

class CartCreateRequestTest extends RequestTestCase
{
    const CART_CREATE_REQUEST = '\Commercetools\Core\Request\Carts\CartCreateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(CartCreateRequest::ofDraft(CartDraft::ofCurrency('EUR')));
        $this->assertInstanceOf('\Commercetools\Core\Model\Cart\Cart', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(CartCreateRequest::ofDraft(CartDraft::ofCurrency('EUR')));
        $this->assertNull($result);
    }
}
