<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\AttributeCollection;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\DateDecorator;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Set;
use Commercetools\Core\Model\Common\TimeDecorator;
use Commercetools\Core\Model\Type\DateTimeType;
use Commercetools\Core\Model\Type\DateType;
use Commercetools\Core\Model\Type\EnumType;
use Commercetools\Core\Model\Type\LocalizedEnumType;
use Commercetools\Core\Model\Type\LocalizedStringType;
use Commercetools\Core\Model\Type\MoneyType;
use Commercetools\Core\Model\Type\ReferenceType;
use Commercetools\Core\Model\Type\SetType;
use Commercetools\Core\Model\Type\TimeType;

/**
 * Class CustomFieldObjectTest
 * @package Commercetools\Core\Model\CustomField
 */
class CustomFieldObjectTest extends \PHPUnit\Framework\TestCase
{
    protected function getContainer()
    {
        $customType = [
            'type' => [
                'obj' => [
                    'fieldDefinitions' => [
                        [
                            'name' => 'active',
                            'type' => [
                                'name' => 'Boolean'
                            ]
                        ],
                        [
                            'name' => 'description',
                            'type' => [
                                'name' => 'String'
                            ]
                        ],
                        [
                            'name' => 'name',
                            'type' => [
                                'name' => 'LocalizedString'
                            ]
                        ],
                        [
                            'name' => 'size',
                            'type' => [
                                'name' => 'Number'
                            ]
                        ],
                        [
                            'name' => 'price',
                            'type' => [
                                'name' => 'Money'
                            ]
                        ],
                        [
                            'name' => 'brand',
                            'type' => [
                                'name' => 'Enum',
                                'values' => [
                                    [
                                        'key' => 'audi',
                                        'label' => 'Audi',
                                    ],
                                    [
                                        'key' => 'bmw',
                                        'label' => 'BMW',
                                    ]
                                ]
                            ]
                        ],
                        [
                            'name' => 'features',
                            'type' => [
                                'name' => 'Set',
                                'elementType' => [
                                    'name' => 'LocalizedEnum',
                                    'values' => [
                                        [
                                            'key' => 'aircondition',
                                            'label' => [
                                                'en' => 'Air Condition',
                                            ]
                                        ],
                                        [
                                            'key' => 'navigation',
                                            'label' => [
                                                'en' => 'Navigation System',
                                            ],
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return CustomFieldObject::fromArray($customType);
    }

    public function testFields()
    {
        $this->assertArrayHasKey('type', $this->getContainer()->fieldDefinitions());
        $this->assertArrayHasKey('fields', $this->getContainer()->fieldDefinitions());
    }

    public function getCustomFields()
    {
        return [
            'active' => [
                ['active' => false],
                'boolean'
            ],
            'description' => [
                ['description' => 'my description'],
                'string'
            ],
            'name' => [
                ['name' => ['en' => 'My awesome Shirt']],
                LocalizedString::class
            ],
            'size' => [
                ['size' => 48],
                'integer'
            ],
            'price' => [
                ['price' => ['centAmount' => 100, 'currency' => 'EUR']],
                Money::class
            ],
            'brand' => [
                ['brand' => ['key' => 'bmw', 'label' => 'BMW']],
                Enum::class
            ],
            'features' => [
                ['features' => [['key' => 'aircondition'], ['key' => 'navigation']]],
                Set::class,
                LocalizedEnum::class,
            ]
        ];
    }

    /**
     * @dataProvider getCustomFields
     */
    public function testData($dataArray, $type, $elementType = null)
    {
        $key = key($dataArray);
        $value = current($dataArray);
        $customFields = $this->getContainer();
        $customFields->setFields(FieldContainer::fromArray($dataArray));
        $fieldGet = 'get'.ucfirst($key);

        $field = $customFields->getFields()->$fieldGet();

        if ($field instanceof Collection) {
            $this->assertInstanceOf($elementType, $field->getAt(0));
        }
        if (is_object($field)) {
            $this->assertInstanceOf($type, $field);
        } else {
            $this->assertInternalType($type, $field);
        }
        $this->assertJsonStringEqualsJsonString(json_encode($value), json_encode($field));
    }


    public function testHasField()
    {
        $container = FieldContainer::of();
        $this->assertFalse($container->hasField('test'));

        $container->set('test', 1234);
        $this->assertTrue($container->hasField('test'));
    }


    public function valueTypeProvider()
    {
        return [
            'string' => ['string', 'getFieldAsString', 'string'],
            'int' => ['int', 'getFieldAsInteger', 'int'],
            'float' => ['float', 'getFieldAsNumber', 'float'],
            'bool' => ['bool', 'getFieldAsBool', 'bool'],
            'ltext' => [LocalizedString::class, 'getFieldAsLocalizedString', LocalizedStringType::NAME],
            'enum' => [Enum::class, 'getFieldAsEnum', EnumType::NAME],
            'lenum' => [LocalizedEnum::class, 'getFieldAsLocalizedEnum', LocalizedEnumType::NAME],
            'money' => [Money::class, 'getFieldAsMoney', MoneyType::NAME],
            'date' => [DateDecorator::class, 'getFieldAsDate', DateType::NAME],
            'time' => [TimeDecorator::class, 'getFieldAsTime', TimeType::NAME],
            'datetime' => [DateTimeDecorator::class, 'getFieldAsDateTime', DateTimeType::NAME],
            'reference' => [CategoryReference::class, 'getFieldAsReference', ReferenceType::NAME],
            'string-set' => [Set::class, 'getFieldAsStringSet', 'string-' . SetType::NAME, 'string'],
            'int-set' => [Set::class, 'getFieldAsIntegerSet', 'int-' . SetType::NAME, 'int'],
            'float-set' => [Set::class, 'getFieldAsNumberSet', 'float-' . SetType::NAME, 'float'],
            'bool-set' => [Set::class, 'getFieldAsBoolSet', 'bool-' . SetType::NAME, 'bool'],
            'ltext-set' => [Set::class, 'getFieldAsLocalizedStringSet', LocalizedStringType::NAME . '-' . SetType::NAME, LocalizedString::class],
            'enum-set' => [Set::class, 'getFieldAsEnumSet', EnumType::NAME . '-' . SetType::NAME, Enum::class],
            'lenum-set' => [Set::class, 'getFieldAsLocalizedEnumSet', LocalizedEnumType::NAME . '-' . SetType::NAME, LocalizedEnum::class],
            'money-set' => [Set::class, 'getFieldAsMoneySet', MoneyType::NAME . '-' . SetType::NAME, Money::class],
            'reference-set' => [Set::class, 'getFieldAsReferenceSet', ReferenceType::NAME . '-' . SetType::NAME, CategoryReference::class],
            'date-set' => [Set::class, 'getFieldAsDateSet', DateType::NAME . '-' . SetType::NAME, DateDecorator::class],
            'time-set' => [Set::class, 'getFieldAsTimeSet', TimeType::NAME . '-' . SetType::NAME, TimeDecorator::class],
            'datetime-set' => [Set::class, 'getFieldAsDateTimeSet', DateTimeType::NAME . '-' . SetType::NAME, DateTimeDecorator::class],
        ];
    }

    /**
     * @dataProvider valueTypeProvider
     * @param string $expectedType
     */
    public function testFieldContainer($expectedType, $getter, $field, $expectedElementType = null)
    {
        $fields = [
            'string' => 'test',
            'int' => 1,
            'float' => 1.0,
            'bool' => true,
            LocalizedStringType::NAME => ['en' => 'test'],
            EnumType::NAME => ['key' => 'test', 'label' => 'test'],
            LocalizedEnumType::NAME => ['key' => 'test', 'label' => ['en' => 'test']],
            MoneyType::NAME => ['centAmount' => 100, 'currencyCode' => 'EUR'],
            ReferenceType::NAME => ['typeId' => 'category', 'id' => '12345'],
            DateType::NAME => '2015-10-10',
            TimeType::NAME => '10:10',
            DateTimeType::NAME => '2015-10-10',
            'string-' . SetType::NAME => ['test'],
            'int-' . SetType::NAME => [1],
            'float-' . SetType::NAME => [1.0],
            'bool-' . SetType::NAME => [true],
            LocalizedStringType::NAME . '-' . SetType::NAME => [['en' => 'test']],
            EnumType::NAME . '-' . SetType::NAME => [['key' => 'test', 'label' => 'test']],
            LocalizedEnumType::NAME . '-' . SetType::NAME  => [['key' => 'test', 'label' => ['en' => 'test']]],
            MoneyType::NAME . '-' . SetType::NAME => [['centAmount' => 100, 'currencyCode' => 'EUR']],
            ReferenceType::NAME . '-' . SetType::NAME => [['typeId' => 'category', 'id' => '12345']],
            DateType::NAME . '-' . SetType::NAME => ['2015-10-10'],
            TimeType::NAME . '-' . SetType::NAME => ['10:10'],
            DateTimeType::NAME . '-' . SetType::NAME => ['2015-10-10'],

        ];

        $container = FieldContainer::fromArray($fields);

        $value = $container->$getter($field);
        if (is_object($value)) {
            $this->assertInstanceOf($expectedType, $value);
        } else {
            $this->assertInternalType($expectedType, $value);
        }
        if (isset($expectedElementType)) {
            $element = $value->current();
            if (is_object($element)) {
                $this->assertInstanceOf($expectedElementType, $element);
            } else {
                $this->assertInternalType($expectedElementType, $element);
            }
        }

    }
}
