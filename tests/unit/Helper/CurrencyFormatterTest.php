<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper;


use Sphere\Core\Model\Common\Context;

class CurrencyFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultFormatter()
    {
        $context = new Context();
        $context->setLocale('en_US');
        $formatter = new CurrencyFormatter($context);

        $this->assertSame('$1.00', $formatter->format(100, 'USD'));
    }
}
