<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:24
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\ProductType\AttributeDefinition;
use Sphere\Core\Model\ProductType\ProductType;
use Sphere\Core\Model\ProductType\ProductTypeDraft;

/**
 * Class JsonObjectTest
 * @package Sphere\Core\Model\Type
 */
class JsonObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $obj = $this->getMock(
            '\Sphere\Core\Model\Common\JsonObject',
            ['getFields', 'getId'],
            [['key' => 'value', 'true' => true, 'false' => false, 'mixed' => '1']],
            'MockJsonObject'
        );
        $obj->expects($this->any())
            ->method('getFields')
            ->will(
                $this->returnValue(
                    [
                        'key' => [JsonObject::TYPE => 'string'],
                        'dummy' => [JsonObject::TYPE => 'string'],
                        'true' => [JsonObject::TYPE => 'bool'],
                        'false' => [JsonObject::TYPE => 'bool'],
                        'localString' => [JsonObject::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
                        'mixed' => [],
                        'decorator' => [
                            JsonObject::TYPE => '\DateTime',
                            JsonObject::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
                        ]
                    ]
                )
            );
        $obj->expects($this->any())
            ->method('getId')
            ->will(
                $this->returnValue('12345')
            );

        return $obj;
    }

    public function testToArray()
    {
        $this->assertSame(
            ['key' => 'value', 'true' => true, 'false' => false, 'mixed' => '1'],
            $this->getObject()->toArray()
        );
    }

    public function testSerializable()
    {
        $this->getObject()->getLocalString();
        $this->getObject()->getDecorator();

        $this->assertJsonStringEqualsJsonString(
            json_encode(['key' => 'value', 'true' => true, 'false' => false, 'mixed' => '1']),
            json_encode($this->getObject()->jsonSerialize())
        );
    }


    public function testInterface()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getObject());
    }

    public function testGet()
    {
        $this->assertSame('value', $this->getObject()->getKey());
    }

    public function testSet()
    {
        $this->assertSame('newValue', $this->getObject()->setKey('newValue')->getKey());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongType()
    {
        $this->getObject()->setKey(1);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testGetUnknownField()
    {
        $this->getObject()->getUnknown();
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testSetUnknownField()
    {
        $this->getObject()->setUnknown('unknown');
    }

    public function testGetFields()
    {
        $obj = JsonObject::of();
        $this->assertSame([], $obj->getFields());
    }

    public function testConstruct()
    {
        $obj = JsonObject::fromArray(['key' => 'value']);
        $this->assertSame(['key' => 'value'], $obj->toArray());
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testUnknownAction()
    {
        $this->getObject()->hasKey();
    }

    public function testGetNotTyped()
    {
        $this->assertSame('1', $this->getObject()->getMixed());
    }

    public function testNotTyped()
    {
        $this->assertSame(1.5, $this->getObject()->setMixed(1.5)->getMixed());
    }

    public function testOf()
    {
        $this->assertInstanceOf('\Sphere\Core\Model\Common\JsonObject', JsonObject::of());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetNull()
    {
        $this->getObject()->setKey(null);
    }

    public function testInitialize()
    {
        $obj = $this->getObject();
        $obj->setRawData(['localString' => ['en' => 'test']]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\LocalizedString', $obj->getLocalString());
    }

    public function testMappedToArray()
    {
        $obj = $this->getObject();
        $obj->setRawData(['localString' => ['en' => 'test']]);
        $obj->getLocalString()->add('en', 'newValue');

        $json = json_encode($obj);
        $this->assertSame('{"localString":{"en":"newValue"}}', $json);
    }

    public function testFromArray()
    {
        $obj = JsonObject::fromArray(['key' => 'value']);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\JsonObject', $obj);
    }

    public function testGetReturnRaw()
    {
        $obj = $this->getMock('\Sphere\Core\Model\Common\JsonObject', ['initialize'], [['key' => 'value']]);
        $this->assertSame('value', $obj->get('key'));
    }

    public function testDecorated()
    {
        $obj = $this->getObject();
        $obj->setRawData(['decorator' => new \DateTime('2015-10-15 15:16:32')]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\DateTimeDecorator', $obj->getDecorator());
    }

    public function testDecoratedString()
    {
        $obj = $this->getObject();
        $obj->setRawData(['decorator' => new \DateTime('2015-10-15 15:16:32')]);
        $this->assertSame('"2015-10-15T15:16:32+00:00"', json_encode($obj->getDecorator()));
    }

    public function testSetDecorator()
    {
        $obj = $this->getObject();
        $obj->setDecorator(new \DateTime());
        $this->assertInstanceOf('\Sphere\Core\Model\Common\DateTimeDecorator', $obj->getDecorator());
    }

    public function testContextInheritance()
    {
        $obj = ProductTypeDraft::ofNameAndDescription('test', 'test');
        $obj->getAttributes()->add(AttributeDefinition::of()->setName('test'));
        $context = $obj->getContext();
        $contextChild = $obj->getAttributes()->getAt(0)->getContext();
        $contextChild['test']= 'test';

        $this->assertSame('test', $context['test']);
    }
}
