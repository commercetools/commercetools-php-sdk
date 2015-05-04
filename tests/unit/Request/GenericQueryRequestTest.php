<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\RequestTestCase;

class GenericQueryRequestTest extends RequestTestCase
{
    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
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
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
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
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Messages\MessagesQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Orders\OrdersQueryRequest',
                '\Sphere\Core\Model\Order\OrderCollection',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Products\ProductsQueryRequest',
                '\Sphere\Core\Model\Product\ProductCollection',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypesQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodsQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\States\StatesQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoriesQueryRequest',
                '\Sphere\Core\Model\Common\Collection',
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
