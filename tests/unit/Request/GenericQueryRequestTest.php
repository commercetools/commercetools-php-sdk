<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountCollection;
use Commercetools\Core\Model\Category\CategoryCollection;
use Commercetools\Core\Model\Channel\ChannelCollection;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Customer\CustomerCollection;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupCollection;
use Commercetools\Core\Model\CustomObject\CustomObjectCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCodeCollection;
use Commercetools\Core\Model\Inventory\InventoryEntryCollection;
use Commercetools\Core\Model\Message\MessageCollection;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Model\OrderEdit\OrderEditCollection;
use Commercetools\Core\Model\Payment\PaymentCollection;
use Commercetools\Core\Model\Product\ProductCollection;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection;
use Commercetools\Core\Model\ProductType\ProductTypeCollection;
use Commercetools\Core\Model\Review\ReviewCollection;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Model\ShoppingList\ShoppingListCollection;
use Commercetools\Core\Model\State\StateCollection;
use Commercetools\Core\Model\Subscription\SubscriptionCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategoryCollection;
use Commercetools\Core\Model\Type\TypeCollection;
use Commercetools\Core\Model\Zone\ZoneCollection;
use Commercetools\Core\Request\CartDiscounts\CartDiscountQueryRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Categories\CategoryQueryRequest;
use Commercetools\Core\Request\Channels\ChannelQueryRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupQueryRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectQueryRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest;
use Commercetools\Core\Request\GraphQL\GraphQLQueryRequest;
use Commercetools\Core\Request\Inventory\InventoryQueryRequest;
use Commercetools\Core\Request\Messages\MessageQueryRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditQueryRequest;
use Commercetools\Core\Request\Orders\OrderQueryRequest;
use Commercetools\Core\Request\Payments\PaymentQueryRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountQueryRequest;
use Commercetools\Core\Request\Products\ProductQueryRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeQueryRequest;
use Commercetools\Core\Request\Reviews\ReviewQueryRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodQueryRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListQueryRequest;
use Commercetools\Core\Request\States\StateQueryRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionQueryRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryQueryRequest;
use Commercetools\Core\Request\Types\TypeQueryRequest;
use Commercetools\Core\Request\Zones\ZoneQueryRequest;
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
            CartDiscountQueryRequest::class => [
                CartDiscountQueryRequest::class,
                CartDiscountCollection::class,
            ],
            CartQueryRequest::class => [
                CartQueryRequest::class,
                CartCollection::class,
                [
                    'results' => [
                        ['id' => 'value'],
                        ['id' => 'value'],
                        ['id' => 'value'],
                    ]
                ]
            ],
            CategoryQueryRequest::class => [
                CategoryQueryRequest::class,
                CategoryCollection::class,
            ],
            ChannelQueryRequest::class => [
                ChannelQueryRequest::class,
                ChannelCollection::class,
            ],
            CustomerGroupQueryRequest::class => [
                CustomerGroupQueryRequest::class,
                CustomerGroupCollection::class,
            ],
            CustomerQueryRequest::class => [
                CustomerQueryRequest::class,
                CustomerCollection::class,
            ],
            CustomObjectQueryRequest::class => [
                CustomObjectQueryRequest::class,
                CustomObjectCollection::class,
                [
                    'results' => [
                        ['container' => 'myNamespace', 'key' => 'key1', 'value' => 'value1'],
                        ['container' => 'myNamespace', 'key' => 'key2', 'value' => 'value2'],
                        ['container' => 'myNamespace', 'key' => 'key3', 'value' => 'value3'],
                    ]
                ]
            ],
            DiscountCodeQueryRequest::class => [
                DiscountCodeQueryRequest::class,
                DiscountCodeCollection::class,
            ],
            InventoryQueryRequest::class => [
                InventoryQueryRequest::class,
                InventoryEntryCollection::class,
            ],
            GraphQLQueryRequest::class => [
                GraphQLQueryRequest::class,
                null
            ],
            MessageQueryRequest::class => [
                MessageQueryRequest::class,
                MessageCollection::class,
            ],
            OrderQueryRequest::class => [
                OrderQueryRequest::class,
                OrderCollection::class,
            ],
            OrderEditQueryRequest::class => [
                OrderEditQueryRequest::class,
                OrderEditCollection::class,
            ],
            PaymentQueryRequest::class => [
                PaymentQueryRequest::class,
                PaymentCollection::class,
            ],
            ProductDiscountQueryRequest::class => [
                ProductDiscountQueryRequest::class,
                ProductDiscountCollection::class,
            ],
            ProductQueryRequest::class => [
                ProductQueryRequest::class,
                ProductCollection::class,
            ],
            ProductTypeQueryRequest::class => [
                ProductTypeQueryRequest::class,
                ProductTypeCollection::class,
            ],
            ReviewQueryRequest::class => [
                ReviewQueryRequest::class,
                ReviewCollection::class,
            ],
            ShippingMethodQueryRequest::class => [
                ShippingMethodQueryRequest::class,
                ShippingMethodCollection::class,
            ],
            ShoppingListQueryRequest::class => [
                ShoppingListQueryRequest::class,
                ShoppingListCollection::class,
            ],
            StateQueryRequest::class => [
                StateQueryRequest::class,
                StateCollection::class,
            ],
            SubscriptionQueryRequest::class => [
                SubscriptionQueryRequest::class,
                SubscriptionCollection::class,
            ],
            TaxCategoryQueryRequest::class => [
                TaxCategoryQueryRequest::class,
                TaxCategoryCollection::class,
            ],
            TypeQueryRequest::class => [
                TypeQueryRequest::class,
                TypeCollection::class,
            ],
            ZoneQueryRequest::class => [
                ZoneQueryRequest::class,
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
        if (is_null($resultClass)) {
            $this->markTestSkipped();
        }
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
        if (is_null($resultClass)) {
            $this->markTestSkipped();
        }
        $result = $this->mapEmptyResult($requestClass);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testBuilder($requestClass, $resultClass)
    {
        $class = new \ReflectionClass($requestClass);
        $domain = lcfirst(basename(dirname($class->getFileName())));

        $builder = RequestBuilder::of();

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->query('');
        $this->assertInstanceOf($requestClass, $request);
    }
}
