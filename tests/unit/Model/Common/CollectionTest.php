<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Model\Product\ProductProjectionCollection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    protected function getCollection()
    {
        $collection = Collection::of();

        $obj = $this->getMock(
            '\Commercetools\Core\Model\Common\JsonObject',
            ['fieldDefinitions'],
            [['key' => 'value', 'true' => true, 'false' => false]]
        );
        $obj->expects($this->any())
            ->method('fieldDefinitions')
            ->will(
                $this->returnValue(
                    [
                        'key' => [JsonObject::TYPE => 'string'],
                        'dummy' => [JsonObject::TYPE => 'string'],
                        'true' => [JsonObject::TYPE => 'bool'],
                        'false' => [JsonObject::TYPE => 'bool'],
                        'localString' => [JsonObject::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
                        'mixed' => [],
                        'decorator' => [
                            JsonObject::TYPE => '\DateTime',
                            JsonObject::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
                        ]
                    ]
                )
            );

        $collection->add($obj);

        return $collection;
    }

    public function testSerializable()
    {
        $this->assertJsonStringEqualsJsonString(
            json_encode([['key' => 'value', 'true' => true, 'false' => false]]),
            json_encode($this->getCollection())
        );
    }

    public function testInterface()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getCollection());
    }

    public function testOf()
    {
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Collection', Collection::of());
    }

    public function testSetType()
    {
        $obj = Collection::of();
        $obj->setType('\DateTime');
        $obj->add(new \DateTime());

        $this->assertInstanceOf('\DateTime', $obj->getAt(0));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongType()
    {
        $obj = Collection::of();
        $obj->setType('\DateTime');
        $obj->add('test');
    }

    public function testFromArray()
    {
        $obj = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $obj->setType('\Commercetools\Core\Model\Common\Money');
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Money', $obj->getAt(0));
        $this->assertSame('EUR', $obj->getAt(0)->getCurrencyCode());
        $this->assertSame(100, $obj->getAt(0)->getCentAmount());
    }

    public function testCount()
    {
        $obj = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $this->assertSame(2, count($obj));
    }

    public function testIterator()
    {
        $collection = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $collection->setType('\Commercetools\Core\Model\Common\Money');

        $i = 0;
        foreach ($collection as $key => $obj) {
            $this->assertSame($key, $i);
            $this->assertInstanceOf('\Commercetools\Core\Model\Common\Money', $obj);
            $i++;
        }
        $this->assertSame($collection->count(), $i);
    }

    public function testIteratorTyped()
    {
        $collection = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $collection->setType('\Commercetools\Core\Model\Common\Money');
        $collection->getAt(1);
        $i = 0;
        foreach ($collection as $key => $obj) {
            $this->assertSame($key, $i);
            $this->assertInstanceOf('\Commercetools\Core\Model\Common\Money', $obj);
            $i++;
        }
        $this->assertSame($collection->count(), $i);
    }

    public function testNamedIterator()
    {
        $data = [
            'eur' => ['currencyCode' => 'EUR', 'centAmount' => 100],
            'usd' => ['currencyCode' => 'USD', 'centAmount' => 110],
        ];
        $collection = Collection::fromArray($data);
        $collection->setType('\Commercetools\Core\Model\Common\Money');

        $i = 0;
        $keys = array_keys($data);
        foreach ($collection as $key => $obj) {
            $this->assertSame($keys[$i], $key);
            $this->assertInstanceOf('\Commercetools\Core\Model\Common\Money', $obj);
            $i++;
        }
        $this->assertSame($collection->count(), $i);
    }

    public function testNamedIteratorTyped()
    {
        $data = [
            'eur' => ['currencyCode' => 'EUR', 'centAmount' => 100],
            'usd' => ['currencyCode' => 'USD', 'centAmount' => 110],
        ];
        $collection = Collection::fromArray($data);
        $collection->setType('\Commercetools\Core\Model\Common\Money');
        $collection->getAt('usd');

        $i = 0;
        $keys = array_keys($data);
        foreach ($collection as $key => $obj) {
            $this->assertSame($keys[$i], $key);
            $this->assertInstanceOf('\Commercetools\Core\Model\Common\Money', $obj);
            $i++;
        }
        $this->assertSame($collection->count(), $i);
    }

    public function testOffsetSet()
    {
        $collection = Collection::of();
        $collection->setType('\DateTime');
        $collection[] = new \DateTime();

        $this->assertInstanceOf('\DateTime', $collection[0]);
    }

    public function testOffsetUnset()
    {
        $collection = Collection::of();
        $collection->setType('\DateTime');
        $collection[] = new \DateTime();
        unset($collection[0]);

        $this->assertCount(0, $collection);
    }

    public function testIndex()
    {
        $collection = ProductProjectionCollection::fromArray([['id' => '12345']]);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\ProductProjection', $collection->getById('12345'));
    }

    public function testNotIndexed()
    {
        $collection = ProductProjectionCollection::fromArray([['id' => '12345']]);
        $this->assertNull($collection->getById('123'));
    }

    public function testGetReturnRaw()
    {
        $collection = $this->getMock(
            '\Commercetools\Core\Model\Common\Collection',
            ['initialize'],
            [[new \DateTime('2015-01-01')]]
        );
        $collection->setType('\DateTime');
        $this->assertSame('2015-01-01', $collection->current()->format('Y-m-d'));
    }

    public function testSetAt()
    {
        $collection = Collection::of();
        $collection->setType('\DateTime');
        $collection[1] = new \DateTime();

        $this->assertInstanceOf('\DateTime', $collection[1]);
    }

    public function testAdd()
    {
        $collection = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
        ]);
        $collection->setType('\Commercetools\Core\Model\Common\Money');
        $collection->add(Money::ofCurrencyAndAmount('USD', 110));

        $this->assertCount(2, $collection);
    }
}
