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
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Channels\ChannelUpdateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest;
use Commercetools\Core\Request\Inventory\InventoryUpdateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditUpdateRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest;
use Commercetools\Core\Request\Reviews\ReviewUpdateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListUpdateRequest;
use Commercetools\Core\Request\States\StateUpdateRequest;
use Commercetools\Core\Request\Stores\StoreUpdateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionUpdateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest;
use Commercetools\Core\Request\Types\TypeUpdateRequest;
use Commercetools\Core\Request\Zones\ZoneUpdateRequest;
use Commercetools\Core\RequestTestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class GenericUpdateRequestTest extends RequestTestCase
{
    use ProphecyTrait;

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
            CartDiscountUpdateRequest::class => [
                CartDiscountUpdateRequest::class,
                CartDiscount::class,
            ],
            CartUpdateRequest::class => [
                CartUpdateRequest::class,
                Cart::class,
            ],
            CategoryUpdateRequest::class => [
                CategoryUpdateRequest::class,
                Category::class,
            ],
            ChannelUpdateRequest::class => [
                ChannelUpdateRequest::class,
                Channel::class,
            ],
            CustomerGroupUpdateRequest::class => [
                CustomerGroupUpdateRequest::class,
                CustomerGroup::class,
            ],
            CustomerUpdateRequest::class => [
                CustomerUpdateRequest::class,
                Customer::class,
            ],
            DiscountCodeUpdateRequest::class => [
                DiscountCodeUpdateRequest::class,
                DiscountCode::class,
            ],
            InventoryUpdateRequest::class => [
                InventoryUpdateRequest::class,
                InventoryEntry::class,
            ],
            OrderEditUpdateRequest::class => [
                OrderEditUpdateRequest::class,
                OrderEdit::class,
            ],
            OrderUpdateRequest::class => [
                OrderUpdateRequest::class,
                Order::class,
            ],
            PaymentUpdateRequest::class => [
                PaymentUpdateRequest::class,
                Payment::class,
            ],
            ProductDiscountUpdateRequest::class => [
                ProductDiscountUpdateRequest::class,
                ProductDiscount::class,
            ],
            ProductUpdateRequest::class => [
                ProductUpdateRequest::class,
                Product::class,
            ],
            ProductTypeUpdateRequest::class => [
                ProductTypeUpdateRequest::class,
                ProductType::class,
            ],
            ReviewUpdateRequest::class => [
                ReviewUpdateRequest::class,
                Review::class,
            ],
            ShippingMethodUpdateRequest::class => [
                ShippingMethodUpdateRequest::class,
                ShippingMethod::class,
            ],
            ShoppingListUpdateRequest::class => [
                ShoppingListUpdateRequest::class,
                ShoppingList::class,
            ],
            StateUpdateRequest::class => [
                StateUpdateRequest::class,
                State::class,
            ],
            SubscriptionUpdateRequest::class => [
                SubscriptionUpdateRequest::class,
                Subscription::class,
            ],
            TaxCategoryUpdateRequest::class => [
                TaxCategoryUpdateRequest::class,
                TaxCategory::class,
            ],
            TypeUpdateRequest::class => [
                TypeUpdateRequest::class,
                Type::class,
            ],
            ZoneUpdateRequest::class => [
                ZoneUpdateRequest::class,
                Zone::class,
            ],
            StoreUpdateRequest::class => [
                StoreUpdateRequest::class,
                Store::class,
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
        $request = $domainBuilder->update($result->reveal());
        $this->assertInstanceOf($requestClass, $request);
    }
}
