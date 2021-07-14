<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Category\CategoryDraft;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Channel\ChannelDraft;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\Review\ReviewDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShoppingList\ShoppingList;
use Commercetools\Core\Model\ShoppingList\ShoppingListDraft;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Model\Subscription\Subscription;
use Commercetools\Core\Model\Subscription\SubscriptionDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Categories\CategoryCreateRequest;
use Commercetools\Core\Request\Channels\ChannelCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountCreateRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\Reviews\ReviewCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListCreateRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Request\Subscriptions\SubscriptionCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\RequestTestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class GenericCreateRequestTest extends RequestTestCase
{
    use ProphecyTrait;

    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $draftClass = current($args);
        $draft = $this->prophesize($draftClass);
        $request = call_user_func_array($className . '::ofDraft', [$draft->reveal()]);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            CartDiscountCreateRequest::class => [
                CartDiscountCreateRequest::class,
                CartDiscount::class,
                CartDiscountDraft::class,
            ],
            CartCreateRequest::class => [
                CartCreateRequest::class,
                Cart::class,
                CartDraft::class,
            ],
            CategoryCreateRequest::class => [
                CategoryCreateRequest::class,
                Category::class,
                CategoryDraft::class,
            ],
            ChannelCreateRequest::class => [
                ChannelCreateRequest::class,
                Channel::class,
                ChannelDraft::class,
            ],
            CustomerGroupCreateRequest::class => [
                CustomerGroupCreateRequest::class,
                CustomerGroup::class,
                CustomerGroupDraft::class,
            ],
            CustomerCreateRequest::class => [
                CustomerCreateRequest::class,
                CustomerSigninResult::class,
                CustomerDraft::class,
            ],
            CustomObjectCreateRequest::class => [
                CustomObjectCreateRequest::class,
                CustomObject::class,
                CustomObjectDraft::class,
            ],
            DiscountCodeCreateRequest::class => [
                DiscountCodeCreateRequest::class,
                DiscountCode::class,
                DiscountCodeDraft::class,
            ],
            InventoryCreateRequest::class => [
                InventoryCreateRequest::class,
                InventoryEntry::class,
                InventoryDraft::class,
            ],
            OrderEditCreateRequest::class => [
                OrderEditCreateRequest::class,
                OrderEdit::class,
                OrderEditDraft::class,
            ],
            PaymentCreateRequest::class => [
                PaymentCreateRequest::class,
                Payment::class,
                PaymentDraft::class,
            ],
            ProductDiscountCreateRequest::class => [
                ProductDiscountCreateRequest::class,
                ProductDiscount::class,
                ProductDiscountDraft::class,
            ],
            ProductCreateRequest::class => [
                ProductCreateRequest::class,
                Product::class,
                ProductDraft::class,
            ],
            ProductTypeCreateRequest::class => [
                ProductTypeCreateRequest::class,
                ProductType::class,
                ProductTypeDraft::class,
            ],
            ReviewCreateRequest::class => [
                ReviewCreateRequest::class,
                Review::class,
                ReviewDraft::class,
            ],
            ShippingMethodCreateRequest::class => [
                ShippingMethodCreateRequest::class,
                ShippingMethod::class,
                ShippingMethodDraft::class,
            ],
            ShoppingListCreateRequest::class => [
                ShoppingListCreateRequest::class,
                ShoppingList::class,
                ShoppingListDraft::class,
            ],
            StateCreateRequest::class => [
                StateCreateRequest::class,
                State::class,
                StateDraft::class,
            ],
            SubscriptionCreateRequest::class => [
                SubscriptionCreateRequest::class,
                Subscription::class,
                SubscriptionDraft::class,
            ],
            TaxCategoryCreateRequest::class => [
                TaxCategoryCreateRequest::class,
                TaxCategory::class,
                TaxCategoryDraft::class,
            ],
            TypeCreateRequest::class => [
                TypeCreateRequest::class,
                Type::class,
                TypeDraft::class,
            ],
            ZoneCreateRequest::class => [
                ZoneCreateRequest::class,
                Zone::class,
                ZoneDraft::class,
            ],
            StoreCreateRequest::class => [
                StoreCreateRequest::class,
                Store::class,
                StoreDraft::class,
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     * @param $draftClass
     */
    public function testMapResult($requestClass, $resultClass, $draftClass)
    {
        $result = $this->mapResult($requestClass, [$draftClass]);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass, $draftClass)
    {
        $result = $this->mapEmptyResult($requestClass, [$draftClass]);
        $this->assertNull($result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     * @param $draftClass
     */
    public function testBuilder($requestClass, $resultClass, $draftClass)
    {
        $class = new \ReflectionClass($requestClass);
        $domain = lcfirst(basename(dirname($class->getFileName())));

        $builder = RequestBuilder::of();

        $domainBuilder = $builder->$domain();
        $request = $domainBuilder->create(new $draftClass());
        $this->assertInstanceOf($requestClass, $request);
    }
}
