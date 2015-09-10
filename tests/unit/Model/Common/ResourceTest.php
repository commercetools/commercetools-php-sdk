<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


use Commercetools\Core\Model\ProductType\ProductType;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $obj = $this->getMockForAbstractClass(
            '\Commercetools\Core\Model\Common\Resource',
            [['id' => '12345']],
            'MockResource',
            true,
            true,
            true,
            ['fieldDefinitions']
        );
        $obj->expects($this->any())
            ->method('fieldDefinitions')
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
        $this->assertInstanceOf('\Commercetools\Core\Model\ProductType\ProductTypeReference', $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "product-type", "id": "123456"}',
            json_encode($reference)
        );
    }

    public function testGetReferenceWithoutReferenceClass()
    {
        $obj = $this->getObject();

        $reference = $obj->getReference();
        $this->assertInstanceOf('\Commercetools\Core\Model\Common\Reference', $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "mock-resource", "id": "12345"}',
            json_encode($reference)
        );
    }
}
