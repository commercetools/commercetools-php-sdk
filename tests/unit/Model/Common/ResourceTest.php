<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;

class ResourceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return JsonObject
     */
    protected function getObject()
    {
        date_default_timezone_set('UTC');
        $obj = $this->getMockForAbstractClass(
            Resource::class,
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
        $this->assertInstanceOf(ProductTypeReference::class, $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "product-type", "id": "123456"}',
            json_encode($reference)
        );
    }

    public function testSerializeNestedReference()
    {
        $method = ShippingMethod::of()->setId('123456');
        $product = CartDraft::of()->setShippingMethod($method->getReference());
        $this->assertJsonStringEqualsJsonString(
            '{ "shippingMethod":{"typeId":"shipping-method", "id":"123456"} }',
            json_encode($product)
        );
    }

    public function testGetReferenceWithoutReferenceClass()
    {
        $obj = $this->getObject();

        $reference = $obj->getReference();
        $this->assertInstanceOf(Reference::class, $reference);
        $this->assertJsonStringEqualsJsonString(
            '{"typeId": "mock-resource", "id": "12345"}',
            json_encode($reference)
        );
    }
}
