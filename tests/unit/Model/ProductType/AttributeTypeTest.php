<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
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
            $type->fieldDefinitions()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeLocalizedEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'lenum'
        ]);
        $this->assertSame(
            '\Commercetools\Core\Model\Common\LocalizedEnumCollection',
            $type->fieldDefinitions()['values'][JsonObject::TYPE]
        );
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testTypeUnset()
    {
        $type = AttributeType::fromArray([
            'name' => 'text'
        ]);
        $type->getValues();
    }
}
