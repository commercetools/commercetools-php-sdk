<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Category\CategoryReference;
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

    public function valueTypeProvider()
    {
        return [
            'string' => ['string', ['name' => 'value-string', 'value' => 'bar'], 'getValueAsString'],
            'int' => ['int', ['name' => 'value-int', 'value' => 1], 'getValueAsNumber'],
            'float' => ['float', ['name' => 'value-float', 'value' => 1.1], 'getValueAsNumber'],
            'bool' => ['bool', ['name' => 'value-bool', 'value' => true], 'getValueAsBool'],
            'ltext' => [LocalizedString::class, ['name' => 'value-ltext', 'value' => ['en' => 'Foo']], 'getValueAsLocalizedString'],
            'enum' => [
                Enum::class,
                ['name' => 'value-enum', 'value' => ['key' => 'foo', 'label' => 'Foo']],
                'getValueAsEnum'
            ],
            'lenum' => [
                LocalizedEnum::class,
                ['name' => 'value-lenum', 'value' => ['key' => 'foo', 'label' => ['en' => 'Foo']]],
                'getValueAsLocalizedEnum'
            ],
            'money' => [
                Money::class,
                ['name' => 'value-money', 'value' => ['currencyCode' => 'EUR', 'centAmount' => 100]],
                'getValueAsMoney'
            ],
            'reference' => [
                CategoryReference::class,
                ['name' => 'value-reference', 'value' => ['typeId' => 'category', 'id' => '123456']],
                'getValueAsReference'
            ],
            'nested' => [
                AttributeCollection::class,
                [
                    'name' => 'value-nested',
                    'value' => [
                        ['name' => 'value-nested_string', 'value' => '1']
                    ]
                ],
                'getValueAsNested'
            ],
            'string-set' => [Set::class, ['name' => 'value-string-set', 'value' => ['value1', 'value2']], 'getValueAsStringSet', 'string'],
            'int-set' => [Set::class, ['name' => 'value-int-set', 'value' => [1, 2]], 'getValueAsNumberSet', 'int'],
            'float-set' => [Set::class, ['name' => 'value-float-set', 'value' => [1.1, 2.2]], 'getValueAsNumberSet', 'float'],
            'bool-set' => [Set::class, ['name' => 'value-bool-set', 'value' => [true, false]], 'getValueAsBoolSet', 'bool'],
            'ltext-set' => [Set::class, ['name' => 'value-ltext-set', 'value' => [['en' => 'Foo'], ['en' => 'Bar']]], 'getValueAsLocalizedStringSet', LocalizedString::class],
            'enum-set' => [Set::class, ['name' => 'value-enum-set', 'value' => [['key' => 'foo', 'label' => 'Foo'], ['key' => 'bar', 'label' => 'Bar']]], 'getValueAsEnumSet', Enum::class],
            'lenum-set' => [Set::class, ['name' => 'value-lenum-set', 'value' => [['key' => 'foo', 'label' => ['en' => 'Foo']], ['key' => 'bar', 'label' => ['en' => 'Bar']]]], 'getValueAsLocalizedEnumSet', LocalizedEnum::class],
            'money-set' => [Set::class, ['name' => 'value-money-set', 'value' => [['currencyCode' => 'EUR', 'centAmount' => 100], ['currencyCode' => 'EUR', 'centAmount' => 200]]], 'getValueAsMoneySet', Money::class],
            'reference-set' => [Set::class, ['name' => 'value-reference-set', 'value' => [['typeId' => 'category', 'id' => '123456'], ['typeId' => 'category', 'id' => 'abcdef']]], 'getValueAsReferenceSet', CategoryReference::class],
            'nested-set' => [
                Set::class,
                [
                    'name' => 'value-nested-set',
                    'value' => [[
                        ['name' => 'value-nested-string', 'value' => '1']
                    ]]
                ],
                'getValueAsNestedSet',
                AttributeCollection::class
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

    /**
     * @dataProvider valueTypeProvider
     * @param string $type
     * @param array $data
     */
    public function testGetValueAs($type, $data, $getter, $elementType = null)
    {
        $attribute = Attribute::fromArray($data);

        $value = $attribute->$getter();
        if (is_object($value)) {
            $this->assertInstanceOf($type, $value);
        } else {
            $this->assertInternalType($type, $value);
        }
        if (isset($elementType)) {
            $element = $value->current();
            if (is_object($element)) {
                $this->assertInstanceOf($elementType, $element);
            } else {
                $this->assertInternalType($elementType, $element);
            }
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
