<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Model\ProductType\AttributeDefinition;
use Sphere\Core\Model\ProductType\AttributeType;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function sphereTypeProvider()
    {
        return [
            ['string', ['name' => 'string', 'value' => 'bar']],
            ['int', ['name' => 'int', 'value' => 1]],
            ['float', ['name' => 'float', 'value' => 1.1]],
            ['bool', ['name' => 'bool', 'value' => true]],
            ['\Sphere\Core\Model\Common\LocalizedString', ['name' => 'ltext', 'value' => ['en' => 'Foo']]],
            ['\Sphere\Core\Model\Common\Enum', ['name' => 'enum', 'value' => ['key' => 'foo', 'label' => 'Foo']]],
            [
                '\Sphere\Core\Model\Common\LocalizedEnum',
                ['name' => 'lenum', 'value' => ['key' => 'foo', 'label' => ['en' => 'Foo']]]
            ],
            [
                '\Sphere\Core\Model\Common\Money',
                ['name' => 'money', 'value' => ['currencyCode' => 'EUR', 'centAmount' => 100]]
            ],
            ['\Sphere\Core\Model\Common\Set', ['name' => 'set', 'value' => ['value1', 'value2']]],
            [
                '\Sphere\Core\Model\Common\Reference',
                ['name' => 'reference', 'value' => ['typeId' => 'reference', 'id' => '123456']]
            ],
            [
                '\Sphere\Core\Model\Common\AttributeCollection',
                [
                    'name' => 'nested',
                    'value' => [
                        ['name' => 'nested_string', 'value' => '1']
                    ]
                ]
            ],
        ];
    }

    /**
     * @dataProvider sphereTypeProvider
     * @param string $type
     * @param array $data
     */
    public function testFromArray($type, $data)
    {
        $attribute = Attribute::fromArray($data);

        if (is_object($attribute->getValue())) {
            $this->assertInstanceOf($type, $attribute->getValue());
        } else {
            $this->assertInternalType($type, $attribute->getValue());
        }
    }

    public function testEnumSet()
    {
        $data = [
            'name' => 'enum-set',
            'value' => [
                ['key' => 'myKey', 'label' => 'myLabel']
            ]
        ];
        $attribute = Attribute::fromArray($data);

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Enum', $attribute->getValue()->getAt(0));
    }

    public function testSameTypeForName()
    {
        $data = [
            'name' => 'test-set',
            'value' => [
                ['key' => 'myKey', 'label' => 'myLabel']
            ]
        ];

        $definition = AttributeDefinition::of()
            ->setName('test-set')
            ->setType(AttributeType::of()->setName('set')->setElementType(AttributeType::of()->setName('enum')));
        Attribute::of()->setAttributeDefinition($definition);

        $attribute2 = Attribute::fromArray(['name' => 'test-set', 'value' => []]);
        $attribute2->getValue()->getAt(0);
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Common\Enum',
            $attribute2->getValue()->getAt(0)
        );
    }

    public function testUnknown()
    {
        $attribute = Attribute::fromArray(['name' => 'unknown-field']);
        $attribute->getValue();
        $this->assertNull($attribute->getFields()['value'][JsonObject::TYPE]);
    }
}
