<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 29.01.15, 12:24
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductType\AttributeDefinition;
use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;

/**
 * Class JsonObjectTest
 * @package Commercetools\Core\Model\Type
 */
class JsonObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $mockBuilder = $this->getMockBuilder(JsonObject::class);
        $mockBuilder->setMethods(['fieldDefinitions', 'getId'])
            ->setConstructorArgs([['key' => 'value', 'true' => true, 'false' => false, 'mixed' => '1']])
            ->setMockClassName('MockJsonObject');
        $obj = $mockBuilder->getMock();

        $obj->expects($this->any())
            ->method('fieldDefinitions')
            ->will(
                $this->returnValue(
                    [
                        'key' => [JsonObject::TYPE => 'string'],
                        'dummy' => [JsonObject::TYPE => 'string'],
                        'true' => [JsonObject::TYPE => 'bool'],
                        'false' => [JsonObject::TYPE => 'bool'],
                        'localString' => [JsonObject::TYPE => LocalizedString::class],
                        'mixed' => [],
                        'decorator' => [
                            JsonObject::TYPE => '\DateTime',
                            JsonObject::DECORATOR => DateTimeDecorator::class
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
     * @expectedExceptionMessage field
     */
    public function testGetUnknownField()
    {
        $this->getObject()->getUnknown();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage field
     */
    public function testSetUnknownField()
    {
        $this->getObject()->setUnknown('unknown');
    }

    public function testFieldDefinitions()
    {
        $obj = JsonObject::of();
        $this->assertSame([], $obj->fieldDefinitions());
    }

    public function testConstruct()
    {
        $obj = JsonObject::fromArray(['key' => 'value']);
        $this->assertSame(['key' => 'value'], $obj->toArray());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage method
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
        $this->assertInstanceOf(JsonObject::class, JsonObject::of());
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
        $this->assertInstanceOf(LocalizedString::class, $obj->getLocalString());
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
        $this->assertInstanceOf(JsonObject::class, $obj);
    }

    public function testGetReturnRaw()
    {
        $obj = $this->getMockBuilder(JsonObject::class)
            ->setMethods(['initialize'])->setConstructorArgs( [['key' => 'value']])
            ->getMock();
        $this->assertSame('value', $obj->get('key'));
    }

    public function testDecorated()
    {
        $obj = $this->getObject();
        $obj->setRawData(['decorator' => new \DateTime('2015-10-15 15:16:32')]);
        $this->assertInstanceOf(DateTimeDecorator::class, $obj->getDecorator());
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
        $this->assertInstanceOf(DateTimeDecorator::class, $obj->getDecorator());
    }

    public function testContextInheritance()
    {
        $obj = ProductTypeDraft::ofNameAndDescription('test', 'test');
        $obj->setAttributes(AttributeDefinitionCollection::of()->add(AttributeDefinition::of()->setName('test')));
        $context = $obj->getContext();
        $contextChild = $obj->getAttributes()->getAt(0)->getContext();

        $this->assertSame($contextChild, $context);
    }

    public function testOptional()
    {
        $mockBuilder = $this->getMockBuilder(JsonObject::class);
        $mockBuilder->setMethods(['fieldDefinitions', 'getId'])
            ->setMockClassName('MockJsonObject');
        $obj = $mockBuilder->getMock();

        $obj->expects($this->any())
            ->method('fieldDefinitions')
            ->will(
                $this->returnValue(
                    [
                        'implicit' => [JsonObject::TYPE => 'string'],
                        'optional' => [JsonObject::TYPE => 'string', JsonObject::OPTIONAL => true],
                        'required' => [JsonObject::TYPE => 'string', JsonObject::OPTIONAL => false],
                    ]
                )
            );
        $obj->expects($this->any())
            ->method('getId')
            ->will(
                $this->returnValue('12345')
            );

        $this->assertFalse($obj->isOptional('implicit'));
        $this->assertTrue($obj->isOptional('optional'));
        $this->assertFalse($obj->isOptional('required'));
    }

    public function testHasField()
    {
        $obj = JsonObject::fromArray(['test' => 1234]);

        $this->assertTrue($obj->hasField('test'));
    }

    public function testNotHasField()
    {
        $obj = JsonObject::fromArray([]);

        $this->assertFalse($obj->hasField('test'));
    }
}
