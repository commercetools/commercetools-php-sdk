<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;


use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;

class LineItemTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTotal()
    {
        $lineItem = LineItem::of();
        $lineItem->setQuantity(3)
            ->setPrice(Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)));

        $this->assertSame(300, $lineItem->getTotal()->getCentAmount());
    }
}
