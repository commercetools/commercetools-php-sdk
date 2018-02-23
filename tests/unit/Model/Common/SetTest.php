<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

class SetTest extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $set = Set::ofType('int')->setRawData([1, 2, 3, 4]);
        $this->assertInstanceOf(
            Set::class,
            $set
        );
    }

    public function testToString()
    {
        $set = Set::ofType('int')->setRawData([1, 2, 3, 4]);
        $this->assertSame('1, 2, 3, 4', (string)$set);
    }

    public function testDateTimeDecorator()
    {
        $set = Set::ofType(DateTimeDecorator::class)->setRawData(["2015-01-01"]);
        $this->assertInstanceOf(DateTimeDecorator::class, $set->current());
    }
}
