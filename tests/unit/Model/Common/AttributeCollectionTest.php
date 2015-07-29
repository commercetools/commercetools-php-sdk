<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Model\ProductType\AttributeDefinition;
use Sphere\Core\Model\ProductType\AttributeDefinitionCollection;
use Sphere\Core\Model\ProductType\AttributeType;

class AttributeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = AttributeCollection::fromArray([
            [
                'name' => 'test'
            ]
        ]);

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testAddToIndex()
    {
        $collection = AttributeCollection::of();
        $collection->add(Attribute::fromArray(['name' => 'test']));

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testMagicGet()
    {
        $collection = AttributeCollection::of();
        $collection->add(Attribute::fromArray(['name' => 'test', 'value' => 'Test']));

        $this->assertSame('Test', $collection->test);
    }

    public function testMagicGetNotSet()
    {
        $collection = AttributeCollection::of();
        $this->assertNull($collection->test);
    }

    public function testSetDefinitions()
    {
        $definitions = AttributeDefinitionCollection::of();
        $definitions->add(
            AttributeDefinition::of()
                ->setName('test-definition-enum')
                ->setType(
                    AttributeType::fromArray([
                        'name' => 'enum',
                        'values' => [
                            ['key' => 'de', 'label' => 'german'],
                            ['key' => 'en', 'label' => 'english'],
                        ]
                    ])
                )
        );

        $collection = AttributeCollection::of();
        $collection->setAttributeDefinitions($definitions);

        $attribute = Attribute::fromArray(
            [
                'name' => 'test-definition-enum',
                'value' => ['label' => 'de', 'key' => 'german']
            ]
        );
        $collection->add($attribute);

        $t = $collection->getByName('test-definition-enum');

        $fields = $t->getFields();
        $this->assertSame('\Sphere\Core\Model\Common\Enum', $fields[Attribute::PROP_VALUE][JsonObject::TYPE]);
        $this->assertNull($fields[Attribute::PROP_VALUE][JsonObject::DECORATOR]);
        $this->assertNull($fields[Attribute::PROP_VALUE][JsonObject::ELEMENT_TYPE]);
    }
}
