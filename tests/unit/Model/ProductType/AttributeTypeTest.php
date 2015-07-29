<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;


use Sphere\Core\Model\Common\JsonObject;

class AttributeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testTypeEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'enum'
        ]);
        $this->assertSame(
            '\Sphere\Core\Model\Common\EnumCollection',
            $type->getFields()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeLocalizedEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'lenum'
        ]);
        $this->assertSame(
            '\Sphere\Core\Model\Common\LocalizedEnumCollection',
            $type->getFields()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeUnset()
    {
        $type = AttributeType::fromArray([
            'name' => 'text'
        ]);
        $this->assertNull($type->getValues());
    }
}
