<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\Cart;


class CartTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getCarts
     */
    public function testEmptyLineItemCount($cart, $quantity)
    {
        $cart = Cart::fromArray($cart);
        $this->assertSame($quantity, $cart->getLineItemCount());
    }

    public function getCarts()
    {
        return [
            [
                [],
                0
            ],
            [
                ['lineItems' => []],
                0
            ],
            [
                ['lineItems' => [['quantity' => 1]]],
                1
            ],
            [
                ['lineItems' => [['quantity' => 1], ['quantity' => 3]]],
                4
            ],
        ];
    }
}
