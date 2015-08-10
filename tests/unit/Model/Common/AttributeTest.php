<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeType;

class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function apiTypeProvider()
    {
        return [
            ['string', ['name' => 'string', 'value' => 'bar']],
            ['int', ['name' => 'int', 'value' => 1]],
            ['float', ['name' => 'float', 'value' => 1.1]],
            ['bool', ['name' => 'bool', 'value' => true]],
            ['\Commercetools\Core\Model\Common\LocalizedString', ['name' => 'ltext', 'value' => ['en' => 'Foo']]],
            ['\Commercetools\Core\Model\Common\Enum', ['name' => 'enum', 'value' => ['key' => 'foo', 'label' => 'Foo']]],
            [
                '\Commercetools\Core\Model\Common\LocalizedEnum',
                ['name' => 'lenum', 'value' => ['key' => 'foo', 'label' => ['en' => 'Foo']]]
            ],
            [
                '\Commercetools\Core\Model\Common\Money',
                ['name' => 'money', 'value' => ['currencyCode' => 'EUR', 'centAmount' => 100]]
            ],
            ['\Commercetools\Core\Model\Common\Set', ['name' => 'set', 'value' => ['value1', 'value2']]],
            [
                '\Commercetools\Core\Model\Common\Reference',
                ['name' => 'reference', 'value' => ['typeId' => 'reference', 'id' => '123456']]
            ],
            [
                '\Commercetools\Core\Model\Common\AttributeCollection',
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
     * @dataProvider apiTypeProvider
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

        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Enum', $attribute->getValue()->getAt(0));
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
            '\Commercetools\Core\Model\Common\Enum',
            $attribute2->getValue()->getAt(0)
        );
    }

    public function testUnknown()
    {
        $attribute = Attribute::fromArray(['name' => 'unknown-field']);
        $attribute->getValue();
        $this->assertNull($attribute->getPropertyDefinitions()['value'][JsonObject::TYPE]);
    }
}
