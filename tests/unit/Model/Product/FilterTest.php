<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;


use Commercetools\Core\Model\Common\JsonObject;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testNumeric()
    {
        $filter = Filter::ofType('int');
        $filter->setName('test')->setValue(10);
        $this->assertSame('test:10', (string)$filter);
    }

    public function testIntString()
    {
        $filter = Filter::of();
        $filter->setName('test')->setValue('10');
        $this->assertSame('test:"10"', (string)$filter);
    }

    public function testIntStringArray()
    {
        $filter = Filter::ofType('array');
        $filter->setName('test')->setValue(['1', '2', '3']);
        $this->assertSame('test:"1","2","3"', (string)$filter);
    }

    public function testFloatStringArray()
    {
        $filter = Filter::ofType('array');
        $filter->setName('test')->setValue(['1.1', '2.2', '3.3']);
        $this->assertSame('test:"1.1","2.2","3.3"', (string)$filter);
    }

    public function testDefaultType()
    {
        $filter = Filter::of();
        $fields = $filter->getPropertyDefinitions();
        $this->assertSame('string', $fields['value'][JsonObject::TYPE]);
    }

    public function testAlias()
    {
        $filter = Filter::ofType('int');
        $filter->setName('test')->setValue(10)->setAlias('foo');
        $this->assertSame('test:10 as foo', (string)$filter);
    }

    public function testString()
    {
        $filter = Filter::ofType('string');
        $filter->setName('test')->setValue('key')->setAlias('foo');
        $this->assertSame('test:"key" as foo', (string)$filter);
    }

    public function testIntArray()
    {
        $filter = Filter::ofType('array');
        $filter->setName('test')->setValue([1, 2, 3])->setAlias('foo');
        $this->assertSame('test:1,2,3 as foo', (string)$filter);
    }

    public function testFloatArray()
    {
        $filter = Filter::ofType('array');
        $filter->setName('test')->setValue([1.1, 2.2, 3.3])->setAlias('foo');
        $this->assertSame('test:1.1,2.2,3.3 as foo', (string)$filter);
    }

    public function testSingleStringInArray()
    {
        $filter = Filter::ofType('array');
        $filter->setName('test')->setValue(["test"])->setAlias('foo');
        $this->assertSame('test:"test" as foo', (string)$filter);
    }

    public function testRange()
    {
        $filter = Filter::ofType('\Commercetools\Core\Model\Product\FilterRangeCollection');

        $filterRangeCollection = FilterRangeCollection::of()
            ->add(FilterRange::ofType('int')->setFrom(1)->setTo(10))
            ->add(FilterRange::ofType('int')->setFrom(11)->setTo(20))
        ;
        $filter->setName('test')->setValue($filterRangeCollection)->setAlias('foo');
        $this->assertSame('test:range(1 to 10),(11 to 20) as foo', (string)$filter);
    }

    public function testBoolTrue()
    {
        $filter = Filter::ofType('bool');
        $filter->setName('test')->setValue(true);
        $this->assertSame('test:true', (string)$filter);
    }

    public function testBoolFalse()
    {
        $filter = Filter::ofType('bool');
        $filter->setName('test')->setValue(false);
        $this->assertSame('test:false', (string)$filter);
    }
}
