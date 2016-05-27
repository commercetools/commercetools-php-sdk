<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Collection;

/**
 * Class CustomFieldObjectTest
 * @package Commercetools\Core\Model\CustomField
 */
class CustomFieldObjectTest extends \PHPUnit_Framework_TestCase
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
            [
                ['active' => false],
                'boolean'
            ],
            [
                ['description' => 'my description'],
                'string'
            ],
            [
                ['name' => ['en' => 'My awesome Shirt']],
                'Commercetools\Core\Model\Common\LocalizedString'
            ],
            [
                ['size' => 48],
                'integer'
            ],
            [
                ['price' => ['centAmount' => 100, 'currency' => 'EUR']],
                'Commercetools\Core\Model\Common\Money'
            ],
            [
                ['brand' => ['key' => 'bmw', 'label' => 'BMW']],
                'Commercetools\Core\Model\Common\Enum'
            ],
            [
                ['features' => [['key' => 'aircondition'], ['key' => 'navigation']]],
                'Commercetools\Core\Model\Common\Set',
                'Commercetools\Core\Model\Common\LocalizedEnum',
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
}
