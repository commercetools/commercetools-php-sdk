<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\State;


class StateCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = StateCollection::fromArray([
            [
                'key' => 'initial'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\State\State', $collection->getByKey('initial'));
    }

    public function testAddToIndex()
    {
        $collection = StateCollection::of();
        $collection->add(new State(['key' => 'initial']));

        $this->assertInstanceOf('\Sphere\Core\Model\State\State', $collection->getByKey('initial'));
    }
}
