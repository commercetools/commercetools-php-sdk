<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testNumeric()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(10);
        $this->assertSame('test:10', (string)$filter);
    }

    public function testIntString()
    {
        $filter = Filter::ofName('test');
        $filter->setValue('10');
        $this->assertSame('test:"10"', (string)$filter);
    }

    public function testIntStringArray()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(['1', '2', '3']);
        $this->assertSame('test:"1","2","3"', (string)$filter);
    }

    public function testFloatStringArray()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(['1.1', '2.2', '3.3']);
        $this->assertSame('test:"1.1","2.2","3.3"', (string)$filter);
    }

    public function testAlias()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(10)->setAlias('foo');
        $this->assertSame('test:10 as foo', (string)$filter);
    }

    public function testString()
    {
        $filter = Filter::ofName('test');
        $filter->setValue('key')->setAlias('foo');
        $this->assertSame('test:"key" as foo', (string)$filter);
    }

    public function testIntArray()
    {
        $filter = Filter::ofName('test');
        $filter->setValue([1, 2, 3])->setAlias('foo');
        $this->assertSame('test:1,2,3 as foo', (string)$filter);
    }

    public function testFloatArray()
    {
        $filter = Filter::ofName('test');
        $filter->setValue([1.1, 2.2, 3.3])->setAlias('foo');
        $this->assertSame('test:1.1,2.2,3.3 as foo', (string)$filter);
    }

    public function testSingleStringInArray()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(["test"])->setAlias('foo');
        $this->assertSame('test:"test" as foo', (string)$filter);
    }

    public function testRange()
    {
        $filter = Filter::ofName('test');

        $filterRangeCollection = FilterRangeCollection::of()
            ->add(FilterRange::ofFromAndTo(1, 10))
            ->add(FilterRange::ofFromAndTo(11, 20))
        ;
        $filter->setValue($filterRangeCollection)->setAlias('foo');
        $this->assertSame('test:range(1 to 10),(11 to 20) as foo', (string)$filter);
    }

    public function testBoolTrue()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(true);
        $this->assertSame('test:true', (string)$filter);
    }

    public function testBoolFalse()
    {
        $filter = Filter::ofName('test');
        $filter->setValue(false);
        $this->assertSame('test:false', (string)$filter);
    }
}
