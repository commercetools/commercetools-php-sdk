<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            '\Commercetools\Core\Model\Common\Money',
            Money::fromArray(['currencyCode' => 'EUR', 'centAmount' => 100])
        );
    }

    public function testToString()
    {
        $context = Context::of();
        $context->getCurrencyFormatter()->setFormatCallback(
            function ($centAmount, $currency) {
                return number_format($centAmount/100, 2) . ' ' . $currency;
            }
        );
        $money = Money::fromArray(['currencyCode' => 'EUR', 'centAmount' => 100], $context);
        $this->assertSame('1.00 EUR', (string)$money);
    }
}
