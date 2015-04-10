<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


class AttributeTest extends \PHPUnit_Framework_TestCase
{
    public function sphereTypeProvider()
    {
        return [
            ['string', ['name' => 'string', 'value' => 'bar']],
            ['float', ['name' => 'int', 'value' => 1]],
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
        $attribute = new Attribute();

        $this->assertSame($type, $attribute->getSphereType($data['name'], $data['value']));
    }

    public function testEnumSet()
    {
        $data = [
            'name' => 'set',
            'value' => [
                ['key' => 'myKey', 'label' => 'myLabel']
            ]
        ];
        $attribute = new Attribute($data);

        $this->assertInstanceOf('\Sphere\Core\Model\Common\Enum', $attribute->getValue()->getAt(0));
    }

    public function testUnknown()
    {
        $attribute = new Attribute();
        $this->assertSame('unknown', $attribute->getSphereType('unknown', new \DateTime()));
    }
}
