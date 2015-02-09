<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:29
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Model\Common\Reference;

class ReferenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Reference
     */
    protected function getReference()
    {
        return Reference::of('test', 'id');
    }

    public function testGetType()
    {
        $this->assertSame('test', $this->getReference()->getTypeId());
    }

    public function testGetId()
    {
        $this->assertSame('id', $this->getReference()->getId());
    }

    public function testFromArray()
    {
        $reference = Reference::fromArray(['typeId' => 'type', 'id' => 'id', 'obj' => 'test']);
        $reference->getId();
        $this->assertSame(['typeId' => 'type', 'id' => 'id', 'obj' => 'test'], $reference->toArray());
    }
}
