<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

class StateCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testIndex()
    {
        $collection = StateCollection::fromArray([
            [
                'key' => 'initial'
            ]
        ]);

        $this->assertInstanceOf(State::class, $collection->getByKey('initial'));
    }

    public function testAddToIndex()
    {
        $collection = StateCollection::of();
        $collection->add(new State(['key' => 'initial']));

        $this->assertInstanceOf(State::class, $collection->getByKey('initial'));
    }
}
