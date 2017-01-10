<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountCollection;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Model\Channel\ChannelCollection;
use Commercetools\Core\Model\Customer\CustomerCollection;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection;
use Commercetools\Core\Model\CustomObject\CustomObjectCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCodeCollection;
use Commercetools\Core\Model\Inventory\InventoryEntryCollection;
use Commercetools\Core\Model\Message\MessageCollection;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Model\Payment\PaymentCollection;
use Commercetools\Core\Model\Product\ProductCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection;
use Commercetools\Core\Model\ProductType\ProductTypeCollection;
use Commercetools\Core\Model\Review\ReviewCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\State\StateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryCollection;
use Commercetools\Core\Model\Type\TypeCollection;
use Commercetools\Core\Model\Zone\ZoneCollection;
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
                CartDiscountCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Carts\CartQueryRequest',
                CartCollection::class,
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
                CategoryCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelQueryRequest',
                ChannelCollection::class,
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest',
                CustomerGroupCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerQueryRequest',
                CustomerCollection::class,
            ],
            [
                '\Commercetools\Core\Request\CustomObjects\CustomObjectQueryRequest',
                CustomObjectCollection::class,
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
                DiscountCodeCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryQueryRequest',
                InventoryEntryCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Messages\MessageQueryRequest',
                MessageCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderQueryRequest',
                OrderCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentQueryRequest',
                PaymentCollection::class,
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest',
                ProductDiscountCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Products\ProductQueryRequest',
                ProductCollection::class,
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest',
                ProductTypeCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewQueryRequest',
                ReviewCollection::class,
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest',
                ShippingMethodCollection::class,
            ],
            [
                '\Commercetools\Core\Request\States\StateQueryRequest',
                StateCollection::class,
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest',
                TaxCategoryCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Types\TypeQueryRequest',
                TypeCollection::class,
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneQueryRequest',
                ZoneCollection::class,
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
