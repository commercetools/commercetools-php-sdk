<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class DateDecoratorTest extends \PHPUnit\Framework\TestCase
{
    public function testJsonSerialize()
    {
        $decorator = new DateDecorator();
        $timezone = new \DateTimeZone('UTC');
        $decorator->setDateTime(new \DateTime('2015-01-01 12:00', $timezone));
        $this->assertSame('2015-01-01', $decorator->jsonSerialize());
    }

    public function testDateOverflow()
    {
        $timezone = new \DateTimeZone('CET');
        $expected = $time = new \DateTime('2015-01-01', $timezone);
        $decorator = new DateDecorator($time);

        $date = $decorator->jsonSerialize();
        $test = new DateDecorator(new \DateTime($date, $timezone));
        $this->assertEquals($expected, $test->getDateTime());
    }
}
