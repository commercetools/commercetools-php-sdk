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
}
