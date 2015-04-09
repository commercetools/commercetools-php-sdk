<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;


use Sphere\Core\Model\Common\Money;
use Sphere\Core\Model\Common\Price;

class LineItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTotal()
    {
        $lineItem = new LineItem();
        $lineItem->setQuantity(3)
            ->setPrice(Price::of(Money::of('EUR', 100)));

        $this->assertSame(300, $lineItem->getTotal()->getCentAmount());
    }
}
