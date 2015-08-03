<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


class DateTimeDecoratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDateTime()
    {
        $decorator = new DateTimeDecorator();
        $this->assertInstanceOf('\DateTime', $decorator->getDateTime());
    }

    public function testSetDateTime()
    {
        $decorator = new DateTimeDecorator();
        $decorator->setDateTime(new \DateTime('2015-01-01'));
        $this->assertSame('2015-01-01', $decorator->getDateTime()->format('Y-m-d'));
    }

    public function testGetUTCDateTime()
    {
        $decorator = new DateTimeDecorator();
        $timezone = new \DateTimeZone('CET');
        $decorator->setDateTime(new \DateTime('2015-01-01 13:00', $timezone));
        $this->assertSame('2015-01-01 12:00', $decorator->getUtcDateTime()->format('Y-m-d H:i'));
    }

    public function testJsonSerialize()
    {
        $decorator = new DateTimeDecorator();
        $timezone = new \DateTimeZone('UTC');
        $decorator->setDateTime(new \DateTime('2015-01-01 12:00', $timezone));
        $this->assertSame('2015-01-01T12:00:00+00:00', $decorator->jsonSerialize());
    }

    public function testFormat()
    {
        $decorator = new DateTimeDecorator();
        $timezone = new \DateTimeZone('UTC');
        $decorator->setDateTime(new \DateTime('2015-01-01 12:00', $timezone));
        $this->assertSame('2015-01-01', $decorator->format('Y-m-d'));
    }

    public function presetProvider()
    {
        return [
            ['2015-01-15T12:00+01:00', '2015-01-15T11:00:00+00:00', null],
            ['2015-01-15T12:00+00:00', '2015-01-15T12:00:00+00:00', null],
            [new \DateTime('2015-01-15T12:00+01:00'), '2015-01-15T11:00:00+00:00', null],
            [new \DateTime('2015-01-15T12:00+00:00'), '2015-01-15T12:00:00+00:00', null],
        ];
    }
    /**
     * @dataProvider presetProvider
     */
    public function testPresets($presetValue, $expectedResult, $format)
    {
        $decorator = new DateTimeDecorator($presetValue);
        $this->assertSame($expectedResult, $decorator->jsonSerialize());
    }
}
