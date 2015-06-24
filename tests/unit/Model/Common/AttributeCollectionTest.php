<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


class AttributeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = AttributeCollection::fromArray([
            [
                'name' => 'test'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testAddToIndex()
    {
        $collection = AttributeCollection::of();
        $collection->add(Attribute::fromArray(['name' => 'test']));

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testMagicGet()
    {
        $collection = AttributeCollection::of();
        $collection->add(Attribute::fromArray(['name' => 'test', 'value' => 'Test']));

        $this->assertSame('Test', $collection->test);
    }

    public function testMagicGetNotSet()
    {
        $collection = AttributeCollection::of();
        $this->assertNull($collection->test);
    }
}
