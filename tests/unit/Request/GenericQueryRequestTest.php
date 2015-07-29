<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

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
                '\Sphere\Core\Request\CartDiscounts\CartDiscountQueryRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscountCollection',
            ],
            [
                '\Sphere\Core\Request\Carts\CartQueryRequest',
                '\Sphere\Core\Model\Cart\CartCollection',
                [
                    'results' => [
                        ['id' => 'value'],
                        ['id' => 'value'],
                        ['id' => 'value'],
                    ]
                ]
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryQueryRequest',
                '\Sphere\Core\Model\Category\CategoryCollection',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelQueryRequest',
                '\Sphere\Core\Model\Channel\ChannelCollection',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentQueryRequest',
                '\Sphere\Core\Model\Comment\CommentCollection',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupQueryRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroupCollection',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerQueryRequest',
                '\Sphere\Core\Model\Customer\CustomerCollection',
            ],
            [
                '\Sphere\Core\Request\CustomObjects\CustomObjectQueryRequest',
                '\Sphere\Core\Model\CustomObject\CustomObjectCollection',
                [
                    'results' => [
                        ['container' => 'myNamespace', 'key' => 'key1', 'value' => 'value1'],
                        ['container' => 'myNamespace', 'key' => 'key2', 'value' => 'value2'],
                        ['container' => 'myNamespace', 'key' => 'key3', 'value' => 'value3'],
                    ]
                ]
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeQueryRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCodeCollection',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryQueryRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntryCollection',
            ],
            [
                '\Sphere\Core\Request\Messages\MessageQueryRequest',
                '\Sphere\Core\Model\Message\MessageCollection',
            ],
            [
                '\Sphere\Core\Request\Orders\OrderQueryRequest',
                '\Sphere\Core\Model\Order\OrderCollection',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountQueryRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscountCollection',
            ],
            [
                '\Sphere\Core\Request\Products\ProductQueryRequest',
                '\Sphere\Core\Model\Product\ProductCollection',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeQueryRequest',
                '\Sphere\Core\Model\ProductType\ProductTypeCollection',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewQueryRequest',
                '\Sphere\Core\Model\Review\ReviewCollection',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodQueryRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethodCollection',
            ],
            [
                '\Sphere\Core\Request\States\StateQueryRequest',
                '\Sphere\Core\Model\State\StateCollection',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryQueryRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategoryCollection',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneQueryRequest',
                '\Sphere\Core\Model\Zone\ZoneCollection',
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
