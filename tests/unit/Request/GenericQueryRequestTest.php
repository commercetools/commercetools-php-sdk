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
                '\Sphere\Core\Request\CartDiscounts\CartDiscountsQueryRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscountCollection',
            ],
            [
                '\Sphere\Core\Request\Carts\CartsQueryRequest',
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
                '\Sphere\Core\Request\Categories\CategoriesQueryRequest',
                '\Sphere\Core\Model\Category\CategoryCollection',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelsQueryRequest',
                '\Sphere\Core\Model\Channel\ChannelCollection',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentsQueryRequest',
                '\Sphere\Core\Model\Comment\CommentCollection',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupsQueryRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroupCollection',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomersQueryRequest',
                '\Sphere\Core\Model\Customer\CustomerCollection',
            ],
            [
                '\Sphere\Core\Request\CustomObjects\CustomObjectsQueryRequest',
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
                '\Sphere\Core\Request\DiscountCodes\DiscountCodesQueryRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCodeCollection',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryQueryRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntryCollection',
            ],
            [
                '\Sphere\Core\Request\Messages\MessagesQueryRequest',
                '\Sphere\Core\Model\Message\MessageCollection',
            ],
            [
                '\Sphere\Core\Request\Orders\OrdersQueryRequest',
                '\Sphere\Core\Model\Order\OrderCollection',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountsQueryRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscountCollection',
            ],
            [
                '\Sphere\Core\Request\Products\ProductsQueryRequest',
                '\Sphere\Core\Model\Product\ProductCollection',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypesQueryRequest',
                '\Sphere\Core\Model\ProductType\ProductTypeCollection',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewsQueryRequest',
                '\Sphere\Core\Model\Review\ReviewCollection',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodsQueryRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethodCollection',
            ],
            [
                '\Sphere\Core\Request\States\StatesQueryRequest',
                '\Sphere\Core\Model\State\StateCollection',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoriesQueryRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategoryCollection',
            ],
            [
                '\Sphere\Core\Request\Zones\ZonesQueryRequest',
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
