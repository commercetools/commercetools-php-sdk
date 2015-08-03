<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:29
 */

namespace Commercetools\Core\Model\Type;


use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeReference;

class ReferenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Reference
     */
    protected function getReference()
    {
        return Reference::ofTypeAndId('test', 'id');
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


    public function testJsonSerialize()
    {
        $object = ProductType::of()->setId('123456');
        $reference = $object->getReference();

        $this->assertJsonStringEqualsJsonString('{"typeId": "product-type", "id": "123456"}', json_encode($reference));
    }
}
