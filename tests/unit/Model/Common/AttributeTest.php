<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeType;

class AttributeTest extends \PHPUnit\Framework\TestCase
{
    public function apiTypeProvider()
    {
        return [
            'string' => ['string', ['name' => 'string', 'value' => 'bar']],
            'int' => ['int', ['name' => 'int', 'value' => 1]],
            'float' => ['float', ['name' => 'float', 'value' => 1.1]],
            'bool' => ['bool', ['name' => 'bool', 'value' => true]],
            'ltext' => [LocalizedString::class, ['name' => 'ltext', 'value' => ['en' => 'Foo']]],
            'enum' => [
                Enum::class,
                ['name' => 'enum', 'value' => ['key' => 'foo', 'label' => 'Foo']]
            ],
            'lenum' => [
                LocalizedEnum::class,
                ['name' => 'lenum', 'value' => ['key' => 'foo', 'label' => ['en' => 'Foo']]]
            ],
            'money' => [
                Money::class,
                ['name' => 'money', 'value' => ['currencyCode' => 'EUR', 'centAmount' => 100]]
            ],
            'set' => [Set::class, ['name' => 'set', 'value' => ['value1', 'value2']]],
            'reference' => [
                Reference::class,
                ['name' => 'reference', 'value' => ['typeId' => 'reference', 'id' => '123456']]
            ],
            'nested' => [
                AttributeCollection::class,
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

        $this->assertInstanceOf(Set::class, $attribute->getValue());
        $this->assertInstanceOf(Enum::class, $attribute->getValue()->getAt(0));
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
            ->setType(AttributeType::fromArray(['name' => 'set', 'elementType' => ['name' => 'enum']]));
        Attribute::of()->setAttributeDefinition($definition);

        $attribute2 = Attribute::fromArray(['name' => 'test-set', 'value' => []]);
        $attribute2->getValue()->getAt(0);
        $this->assertInstanceOf(
            Enum::class,
            $attribute2->getValue()->getAt(0)
        );
    }

    public function testUnknown()
    {
        $attribute = Attribute::fromArray(['name' => 'unknown-field']);
        $attribute->getValue();
        $this->assertEmpty($attribute->fieldDefinition('value'));
    }
}
