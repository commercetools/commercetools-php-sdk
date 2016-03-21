<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\RequestTestCase;

class GenericQueryRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::of', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            [
                '\Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest',
                '\Commercetools\Core\Model\CartDiscount\CartDiscountCollection',
            ],
            [
                '\Commercetools\Core\Request\Carts\CartQueryRequest',
                '\Commercetools\Core\Model\Cart\CartCollection',
                [
                    'results' => [
                        ['id' => 'value'],
                        ['id' => 'value'],
                        ['id' => 'value'],
                    ]
                ]
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryQueryRequest',
                '\Commercetools\Core\Model\Category\CategoryCollection',
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelQueryRequest',
                '\Commercetools\Core\Model\Channel\ChannelCollection',
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest',
                '\Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection',
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerQueryRequest',
                '\Commercetools\Core\Model\Customer\CustomerCollection',
            ],
            [
                '\Commercetools\Core\Request\CustomObjects\CustomObjectQueryRequest',
                '\Commercetools\Core\Model\CustomObject\CustomObjectCollection',
                [
                    'results' => [
                        ['container' => 'myNamespace', 'key' => 'key1', 'value' => 'value1'],
                        ['container' => 'myNamespace', 'key' => 'key2', 'value' => 'value2'],
                        ['container' => 'myNamespace', 'key' => 'key3', 'value' => 'value3'],
                    ]
                ]
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest',
                '\Commercetools\Core\Model\DiscountCode\DiscountCodeCollection',
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryQueryRequest',
                '\Commercetools\Core\Model\Inventory\InventoryEntryCollection',
            ],
            [
                '\Commercetools\Core\Request\Messages\MessageQueryRequest',
                '\Commercetools\Core\Model\Message\MessageCollection',
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderQueryRequest',
                '\Commercetools\Core\Model\Order\OrderCollection',
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentQueryRequest',
                '\Commercetools\Core\Model\Payment\PaymentCollection',
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest',
                '\Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection',
            ],
            [
                '\Commercetools\Core\Request\Products\ProductQueryRequest',
                '\Commercetools\Core\Model\Product\ProductCollection',
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest',
                '\Commercetools\Core\Model\ProductType\ProductTypeCollection',
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewQueryRequest',
                '\Commercetools\Core\Model\Review\ReviewCollection',
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest',
                '\Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection',
            ],
            [
                '\Commercetools\Core\Request\States\StateQueryRequest',
                '\Commercetools\Core\Model\State\StateCollection',
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest',
                '\Commercetools\Core\Model\TaxCategory\TaxCategoryCollection',
            ],
            [
                '\Commercetools\Core\Request\Types\TypeQueryRequest',
                '\Commercetools\Core\Model\Type\TypeCollection',
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneQueryRequest',
                '\Commercetools\Core\Model\Zone\ZoneCollection',
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     * @param $data
     */
    public function testMapResult($requestClass, $resultClass, $data = [])
    {
        $result = $this->mapQueryResult($requestClass, [], $data);
        $this->assertInstanceOf($resultClass, $result);
        $this->assertCount(3, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass);
        $this->assertInstanceOf($resultClass, $result);
    }
}
