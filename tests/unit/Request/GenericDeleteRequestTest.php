<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Categories\CategoryDeleteRequest;
use Commercetools\Core\Request\Channels\ChannelDeleteRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;
use Commercetools\Core\RequestTestCase;

class GenericDeleteRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofIdAndVersion', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            CartDiscountDeleteRequest::class => [
                CartDiscountDeleteRequest::class,
                CartDiscount::class,
            ],
            CartDeleteRequest::class => [
                CartDeleteRequest::class,
                Cart::class,
            ],
            CategoryDeleteRequest::class => [
                CategoryDeleteRequest::class,
                Category::class,
            ],
            ChannelDeleteRequest::class => [
                ChannelDeleteRequest::class,
                Channel::class,
            ],
            CustomerGroupDeleteRequest::class => [
                CustomerGroupDeleteRequest::class,
                CustomerGroup::class,
            ],
            CustomerDeleteRequest::class => [
                CustomerDeleteRequest::class,
                Customer::class,
            ],
            CustomObjectDeleteRequest::class => [
                CustomObjectDeleteRequest::class,
                CustomObject::class,
            ],
            DiscountCodeDeleteRequest::class => [
                DiscountCodeDeleteRequest::class,
                DiscountCode::class,
            ],
            InventoryDeleteRequest::class => [
                InventoryDeleteRequest::class,
                InventoryEntry::class,
            ],
            OrderEditDeleteRequest::class => [
                OrderEditDeleteRequest::class,
                OrderEdit::class,
            ],
            OrderDeleteRequest::class => [
                OrderDeleteRequest::class,
                Order::class,
            ],
            PaymentDeleteRequest::class => [
                PaymentDeleteRequest::class,
                Payment::class,
            ],
            ProductDiscountDeleteRequest::class => [
                ProductDiscountDeleteRequest::class,
                ProductDiscount::class,
            ],
            ProductDeleteRequest::class => [
                ProductDeleteRequest::class,
                Product::class,
            ],
            ProductTypeDeleteRequest::class => [
                ProductTypeDeleteRequest::class,
                ProductType::class,
            ],
            ReviewDeleteRequest::class => [
                ReviewDeleteRequest::class,
                Review::class,
            ],
            ShippingMethodDeleteRequest::class => [
                ShippingMethodDeleteRequest::class,
                ShippingMethod::class,
            ],
            ShoppingListDeleteRequest::class => [
                ShoppingListDeleteRequest::class,
                ShoppingList::class,
            ],
            SubscriptionDeleteRequest::class => [
                SubscriptionDeleteRequest::class,
                Subscription::class,
            ],
            StateDeleteRequest::class => [
                StateDeleteRequest::class,
                State::class,
            ],
            TaxCategoryDeleteRequest::class => [
                TaxCategoryDeleteRequest::class,
                TaxCategory::class,
            ],
            TypeDeleteRequest::class => [
                TypeDeleteRequest::class,
                Type::class,
            ],
            ZoneDeleteRequest::class => [
                ZoneDeleteRequest::class,
                Zone::class,
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapResult($requestClass, $resultClass)
    {
        $result = $this->mapResult($requestClass, ['id', 1]);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['id', 1]);
        $this->assertNull($result);
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

        $result = $this->prophesize($resultClass);

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->delete($result->reveal());
        $this->assertInstanceOf($requestClass, $request);
    }
}
