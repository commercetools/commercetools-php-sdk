<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

use Commercetools\Core\Model\Common\Context;

class CurrencyFormatterTest extends \PHPUnit\Framework\TestCase
{
    public function testDefaultFormatter()
    {
        $context = new Context();
        $context->setLocale('en_US');
        $formatter = new CurrencyFormatter($context);

        $this->assertSame('$1.00', $formatter->format(100, 'USD'));
    }
}
