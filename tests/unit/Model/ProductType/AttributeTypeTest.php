<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use BadMethodCallException;
use Commercetools\Core\Model\Common\EnumCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;

class AttributeTypeTest extends \PHPUnit\Framework\TestCase
{
    public function testTypeEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'enum'
        ]);
        $this->assertSame(
            EnumCollection::class,
            $type->fieldDefinitions()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeLocalizedEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'lenum'
        ]);
        $this->assertSame(
            LocalizedEnumCollection::class,
            $type->fieldDefinitions()['values'][JsonObject::TYPE]
        );
    }

    public function testTypeUnset()
    {
        $type = AttributeType::fromArray([
            'name' => 'text'
        ]);
        $this->expectException(BadMethodCallException::class);
        $type->getValues();
    }
}
