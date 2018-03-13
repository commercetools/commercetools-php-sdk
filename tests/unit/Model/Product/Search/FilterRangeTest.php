<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

use Commercetools\Core\Model\Product\RangeTestObject;

class FilterRangeTest extends \PHPUnit\Framework\TestCase
{
    public function testMapValue()
    {
        $range = FilterRange::of();
        $this->assertSame('(* to *)', (string)$range);
    }

    public function testIntToString()
    {
        $range = FilterRange::of();
        $range->setFrom(1)->setTo(10);
        $this->assertSame('(1 to 10)', (string)$range);
    }

    public function testFloatToString()
    {
        $range = FilterRange::of();
        $range->setFrom(1.2)->setTo(10.3);
        $this->assertSame('(1.2 to 10.3)', (string)$range);
    }

    public function testStringRange()
    {
        $range = FilterRange::of();
        $range->setTo('test');
        $this->assertSame('(* to "test")', (string)$range);
    }

    public function testDateTimeRange()
    {
        $range = FilterRange::of();
        $range->setTo(new \DateTime('2015-01-01 13:11', new \DateTimeZone('CET')));
        $this->assertSame('(* to "2015-01-01T12:11:00+00:00")', (string)$range);
    }

    public function testObjectRange()
    {
        $range = FilterRange::of();
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
