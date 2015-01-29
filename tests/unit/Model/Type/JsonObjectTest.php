<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:24
 */

namespace Sphere\Core\Model\Type;


class JsonObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        $obj = new JsonObject();
        $obj->key = 'value';
        $obj->empty = null;

        return $obj;
    }

    public function testToArray()
    {
        $this->assertSame(['key' => 'value'], $this->getObject()->toArray());
    }

    public function testSerializable()
    {
        $this->assertSame(['key' => 'value'], $this->getObject()->jsonSerialize());
    }

    public function testInterface()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getObject());
    }
}
