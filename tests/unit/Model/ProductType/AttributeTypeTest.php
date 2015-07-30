<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;


use Commercetools\Core\Model\Common\JsonObject;

class AttributeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testTypeEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'enum'
        ]);
        $this->assertSame(
            '\Commercetools\Core\Model\Common\EnumCollection',
            $type->getFields()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeLocalizedEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'lenum'
        ]);
        $this->assertSame(
            '\Commercetools\Core\Model\Common\LocalizedEnumCollection',
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
