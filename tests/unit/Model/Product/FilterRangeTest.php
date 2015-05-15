<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Error\InvalidArgumentException;

class FilterRangeTest extends \PHPUnit_Framework_TestCase
{
    public function testMapValue()
    {
        $range = new FilterRange('int');
        $this->assertSame('(* to *)', (string)$range);
    }

    public function testToString()
    {
        $range = new FilterRange('int');
        $range->setFrom(1)->setTo(10);
        $this->assertSame('(1 to 10)', (string)$range);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeFrom()
    {
        $range = new FilterRange('int');
        $range->setFrom('test');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeTo()
    {
        $range = new FilterRange('int');
        $range->setTo('test');
    }

    public function testStringRange()
    {
        $range = new FilterRange('string');
        $range->setTo('test');
        $this->assertSame('(* to "test")', (string)$range);
    }

    public function testDateTimeRange()
    {
        $range = new FilterRange('\DateTime');
        $range->setTo(new \DateTime('2015-01-01 13:11', new \DateTimeZone('CET')));
        $this->assertSame('(* to "2015-01-01T12:11:00+00:00")', (string)$range);
    }

    public function testObjectRange()
    {
        $range = new FilterRange('\Sphere\Core\Model\Product\RangeTestObject');
        $range->setTo(new RangeTestObject(4, '"'));
        $this->assertSame('(* to "4")', (string)$range);
    }

    public function testDefaultType()
    {
        $range = new FilterRange();
        $range->setTo(1);
        $this->assertTrue(is_int($range->getTo()));
    }
}
