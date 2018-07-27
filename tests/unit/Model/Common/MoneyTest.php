<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
        $this->assertSame('1,00&nbsp;&euro;', $money);
    }

    public function testCentPrecision()
    {
        $money = Money::fromArray(['currencyCode' => 'EUR', 'centAmount' => 100, 'type' => Money::TYPE_CENT_PRECISION]);
        $this->assertInstanceOf(Money::class, $money);
        $this->assertInstanceOf(CentPrecisionMoney::class, $money);
    }

    public function testHighPrecision()
    {
        $money = Money::fromArray(
            [
                'currencyCode' => 'EUR',
                'centAmount' => 100,
                'preciseAmount' => 1000,
                'fractionDigits' => 3,
                'type' => Money::TYPE_HIGH_PRECISION,
            ]
        );
        $this->assertInstanceOf(Money::class, $money);
        $this->assertInstanceOf(HighPrecisionMoney::class, $money);
    }
}
