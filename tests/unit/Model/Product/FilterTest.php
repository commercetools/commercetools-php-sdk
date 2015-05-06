<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Model\Common\JsonObject;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testNumeric()
    {
        $filter = new Filter('int');
        $filter->setName('test')->setValue(10);
        $this->assertSame('test:10', (string)$filter);
    }

    public function testDefaultType()
    {
        $filter = new Filter();
        $fields = $filter->getFields();
        $this->assertSame('string', $fields['value'][JsonObject::TYPE]);
    }

    public function testAlias()
    {
        $filter = new Filter('int');
        $filter->setName('test')->setValue(10)->setAlias('foo');
        $this->assertSame('test:10 as foo', (string)$filter);
    }

    public function testString()
    {
        $filter = new Filter('string');
        $filter->setName('test')->setValue('key')->setAlias('foo');
        $this->assertSame('test:"key" as foo', (string)$filter);
    }

    public function testArray()
    {
        $filter = new Filter('array');
        $filter->setName('test')->setValue([1,2,3])->setAlias('foo');
        $this->assertSame('test:1,2,3 as foo', (string)$filter);
    }

    public function testSingleStringInArray()
    {
        $filter = new Filter('array');
        $filter->setName('test')->setValue(["test"])->setAlias('foo');
        $this->assertSame('test:"test" as foo', (string)$filter);
    }

    public function testRange()
    {
        $filter = new Filter('\Sphere\Core\Model\Product\FilterRangeCollection');

        $filterRangeCollection = FilterRangeCollection::of()
            ->add(FilterRange::of('int')->setFrom(1)->setTo(10))
            ->add(FilterRange::of('int')->setFrom(11)->setTo(20))
        ;
        $filter->setName('test')->setValue($filterRangeCollection)->setAlias('foo');
        $this->assertSame('test:range(1 to 10),(11 to 20) as foo', (string)$filter);
    }
}
