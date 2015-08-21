<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;


use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeReference;

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
                ['active' => false]
            ],
            [
                ['description' => 'my description']
            ],
            [
                ['name' => ['en' => 'My awesome Shirt']]
            ],
            [
                ['size' => 48]
            ],
            [
                ['price' => ['centAmount' => 100, 'currency' => 'EUR']]
            ]
        ];
    }

    /**
     * @dataProvider getCustomFields
     */
    public function testData($dataArray)
    {
        $this->markTestIncomplete();
        return;
        $startTime = microtime(true);
        $key = key($dataArray);
        $value = current($dataArray);
        $customFields = $this->getContainer();
        $customFields->setFields(FieldContainer::fromArray($dataArray));
        $method = 'get'.ucfirst($key);

        $t = $customFields->getFields()->$method();
        $endTime = microtime(true);

        if (is_object($t)) {
            var_dump(get_class($t));
        } else {
            var_dump(gettype($t));
        }
        var_dump($endTime - $startTime);
    }
}
