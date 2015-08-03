<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


class DateDecoratorTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonSerialize()
    {
        $decorator = new DateDecorator();
        $timezone = new \DateTimeZone('UTC');
        $decorator->setDateTime(new \DateTime('2015-01-01 12:00', $timezone));
        $this->assertSame('2015-01-01', $decorator->jsonSerialize());
    }
}
