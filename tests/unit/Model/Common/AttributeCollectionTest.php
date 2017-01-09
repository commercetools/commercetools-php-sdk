<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\AttributeType;
use Commercetools\Core\Model\ProductType\StringType;
use Prophecy\Argument;

class AttributeCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $collection = AttributeCollection::fromArray([
            ['name' => 'test']
        ]);

        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Attribute', $collection->getByName('test'));
    }

    public function testAttributeDefinition()
    {
        $definition = AttributeDefinition::of()->setName('testAttributeDefinition')->setType(StringType::of());
        $collection = AttributeCollection::of()->setAttributeDefinitions(
            AttributeDefinitionCollection::of()->add(
                $definition
            )
        );

        $observer = $this->prophesize('Commercetools\Core\Model\Common\Attribute');
        $observer->setContext(Argument::any())->shouldBeCalled();
        $observer->parentSet($collection)->shouldBeCalled();
        $observer->rootSet($collection)->shouldBeCalled();
        $observer->getName()->shouldBeCalled()->willReturn('testAttributeDefinition');
        $observer->setAttributeDefinition($definition)->shouldBeCalled();

        $collection->add($observer->reveal());
        $collection->getByName('testAttributeDefinition');
    }

    public function testAddToIndex()
    {
        $collection = AttributeCollection::of();
        $collection->add(Attribute::fromArray(['name' => 'test']));

        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Attribute', $collection->getByName('test'));
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

        $this->assertInstanceOf(Enum::class, $t->getValue());
    }
}
