<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

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

        $this->assertInstanceOf(CustomObject::class, $collection->getByKey('myKey'));
        $this->assertInstanceOf(
            CustomObject::class,
            $collection->getByContainerKey('myNamespace', 'myKey')
        );
    }

    public function testAddToIndex()
    {
        $collection = CustomObjectCollection::of();
        $collection->add(new CustomObject(['container' => 'myNamespace', 'key' => 'myKey']));

        $this->assertInstanceOf(CustomObject::class, $collection->getByKey('myKey'));
        $this->assertInstanceOf(
            CustomObject::class,
            $collection->getByContainerKey('myNamespace', 'myKey')
        );
    }
}
