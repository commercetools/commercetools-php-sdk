<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Error\InvalidArgumentException;

class FilterRangeTest extends \PHPUnit_Framework_TestCase
{
    public function testMapValue()
    {
        $range = FilterRange::ofType('int');
        $this->assertSame('(* to *)', (string)$range);
    }

    public function testToString()
    {
        $range = FilterRange::ofType('int');
        $range->setFrom(1)->setTo(10);
        $this->assertSame('(1 to 10)', (string)$range);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeFrom()
    {
        $range = FilterRange::ofType('int');
        $range->setFrom('test');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeTo()
    {
        $range = FilterRange::ofType('int');
        $range->setTo('test');
    }

    public function testStringRange()
    {
        $range = FilterRange::ofType('string');
        $range->setTo('test');
        $this->assertSame('(* to "test")', (string)$range);
    }

    public function testDateTimeRange()
    {
        $range = FilterRange::ofType('\DateTime');
        $range->setTo(new \DateTime('2015-01-01 13:11', new \DateTimeZone('CET')));
        $this->assertSame('(* to "2015-01-01T12:11:00+00:00")', (string)$range);
    }

    public function testObjectRange()
    {
        $range = FilterRange::ofType('\Commercetools\Core\Model\Product\RangeTestObject');
        $range->setTo(new RangeTestObject(4, '"'));
        $this->assertSame('(* to "4")', (string)$range);
    }

    public function testDefaultType()
    {
        $range = FilterRange::of();
        $range->setTo(1);
        $this->assertTrue(is_int($range->getTo()));
    }
}
