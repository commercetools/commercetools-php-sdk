<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Model\ProductType\ProductType;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $obj = $this->getMockForAbstractClass(
            '\Sphere\Core\Model\Common\Resource',
            [['id' => '12345']],
            'MockResource',
            true,
            true,
            true,
            ['getFields']
        );
        $obj->expects($this->any())
            ->method('getFields')
            ->will(
                $this->returnValue(
                    [
                        'id' => [JsonObject::TYPE => 'string']
                    ]
                )
            );

        return $obj;
    }

    public function testGetReference()
    {
        $obj = ProductType::of()->setId('123456');

        $reference = $obj->getReference();
        $this->assertInstanceOf('\Sphere\Core\Model\ProductType\ProductTypeReference', $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "product-type", "id": "123456"}',
            json_encode($reference)
        );
    }

    public function testGetReferenceWithoutReferenceClass()
    {
        $obj = $this->getObject();

        $reference = $obj->getReference();
        $this->assertInstanceOf('\Sphere\Core\Model\Common\Reference', $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "mock-resource", "id": "12345"}',
            json_encode($reference)
        );
    }
}
