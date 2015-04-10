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
        $collection = new AttributeCollection();
        $collection->add(new Attribute(['name' => 'test']));

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testMagicGet()
    {
        $collection = new AttributeCollection();
        $collection->add(new Attribute(['name' => 'test', 'value' => 'Test']));

        $this->assertSame('Test', $collection->test);
    }

    public function testMagicGetNotSet()
    {
        $collection = new AttributeCollection();
        $this->assertNull($collection->test);
    }
}
