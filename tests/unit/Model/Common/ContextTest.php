<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Helper\CurrencyFormatter;

function extension_loaded($value)
{
    if ($value === 'intl') {
        return ContextTest::getIntlLoaded();
    }
    return \extension_loaded($value);
}

class ContextTest extends \PHPUnit_Framework_TestCase
{
    protected static $disableIntl = false;

    public static function getIntlLoaded()
    {
        if (static::$disableIntl) {
            return false;
        }
        return \extension_loaded('intl');
    }

    public function testGetLocale()
    {
        $context = Context::of();
        if (extension_loaded('intl')) {
            $this->assertNotNull($context->getLocale());
        } else {
            $this->assertNull($context->getLocale());
        }
    }

    public function testGetLocaleNoIntlExtension()
    {
        static::$disableIntl = true;
        $context = Context::of();
        $this->assertNull($context->getLocale());
        static::$disableIntl = true;
    }

    public function testSetLocale()
    {
        $context = Context::of();
        $context->setLocale('de_DE');
        $this->assertSame('de_DE', $context->getLocale());
    }

    public function testSetCurrencyFormatter()
    {
        $context = Context::of();
        $formatter = new CurrencyFormatter($context);

        $context->setCurrencyFormatter($formatter);
        $this->assertSame($formatter, $context->getCurrencyFormatter());
    }

    public function testSerialize()
    {
        $context = Context::of();
        $contextStr = serialize($context);
        $this->assertInternalType('string', $contextStr);
    }
}
