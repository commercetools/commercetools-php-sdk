<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class MoneyTest extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $this->assertInstanceOf(
            Money::class,
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

    public function testDefaultFormatUSD()
    {
        $context = Context::of()->setLocale('en_US');
        $money = Money::fromArray(['currencyCode' => 'USD', 'centAmount' => 100], $context);
        $this->assertSame('$1.00', (string)$money);
    }

    public function testDefaultFormatEUR()
    {
        $context = Context::of()->setLocale('de_DE');
        $money = Money::fromArray(['currencyCode' => 'EUR', 'centAmount' => 100], $context);
        $money = htmlentities((string)$money);
        $this->assertEquals('1,00&nbsp;&euro;', $money);
    }
}
