<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CustomObject;


class CustomObjectCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = CustomObjectCollection::fromArray([
            [
                'container' => 'myNamespace',
                'key' => 'myKey'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\CustomObject\CustomObject', $collection->getByKey('myKey'));
        $this->assertInstanceOf(
            '\Sphere\Core\Model\CustomObject\CustomObject',
            $collection->getByContainerKey('myNamespace', 'myKey')
        );
    }

    public function testAddToIndex()
    {
        $collection = CustomObjectCollection::of();
        $collection->add(new CustomObject(['container' => 'myNamespace', 'key' => 'myKey']));

        $this->assertInstanceOf('\Sphere\Core\Model\CustomObject\CustomObject', $collection->getByKey('myKey'));
        $this->assertInstanceOf(
            '\Sphere\Core\Model\CustomObject\CustomObject',
            $collection->getByContainerKey('myNamespace', 'myKey')
        );
    }
}
