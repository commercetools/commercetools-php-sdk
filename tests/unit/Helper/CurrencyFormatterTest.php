<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper;


use Sphere\Core\Model\Common\Context;

function extension_loaded($value)
{
    if ($value === 'intl') {
        return CurrencyFormatterTest::getIntlLoaded();
    }
    return \extension_loaded($value);
}

class CurrencyFormatterTest extends \PHPUnit_Framework_TestCase
{
    protected static $intlActive = true;

    public static function getIntlLoaded()
    {
        return static::$intlActive;
    }

    protected function setUp()
    {
        static::$intlActive = \extension_loaded('intl');
    }


    protected function tearDown()
    {
        parent::tearDown();
        static::$intlActive = \extension_loaded('intl');
    }

    public function testDefaultFormatter()
    {
        $context = new Context();
        $context->setLocale('en_US');
        $formatter = new CurrencyFormatter($context);

        if (extension_loaded('intl')) {
            $this->assertSame('$1.00', $formatter->format(100, 'USD'));
        } else {
            $this->assertSame('1.00 USD', $formatter->format(100, 'USD'));
        }
    }

    public function testDefaultFormatterNoIntl()
    {
        static::$intlActive = false;
        $context = new Context();
        $context->setLocale('en_US');
        $formatter = new CurrencyFormatter($context);
        $this->assertSame('1.00 USD', $formatter->format(100, 'USD'));
    }
}
