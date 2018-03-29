<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Builder\Update\CustomersActionBuilder;
use Commercetools\Core\Builder\Update\ProductTypesActionBuilder;
use Commercetools\Core\Builder\Update\TaxCategoriesActionBuilder;
use Commercetools\Core\Builder\Update\DiscountCodesActionBuilder;
use Commercetools\Core\Builder\Update\PaymentsActionBuilder;
use Commercetools\Core\Builder\Update\TypesActionBuilder;
use Commercetools\Core\Builder\Update\ProductsActionBuilder;
use Commercetools\Core\Builder\Update\ZonesActionBuilder;
use Commercetools\Core\Builder\Update\CustomFieldActionBuilder;
use Commercetools\Core\Builder\Update\CustomerGroupsActionBuilder;
use Commercetools\Core\Builder\Update\ShippingMethodsActionBuilder;
use Commercetools\Core\Builder\Update\ShoppingListsActionBuilder;
use Commercetools\Core\Builder\Update\SubscriptionsActionBuilder;
use Commercetools\Core\Builder\Update\ProjectActionBuilder;
use Commercetools\Core\Builder\Update\CartsActionBuilder;
use Commercetools\Core\Builder\Update\InventoryActionBuilder;
use Commercetools\Core\Builder\Update\StatesActionBuilder;
use Commercetools\Core\Builder\Update\OrdersActionBuilder;
use Commercetools\Core\Builder\Update\ProductDiscountsActionBuilder;
use Commercetools\Core\Builder\Update\CategoriesActionBuilder;
use Commercetools\Core\Builder\Update\CartDiscountsActionBuilder;
use Commercetools\Core\Builder\Update\ReviewsActionBuilder;
use Commercetools\Core\Builder\Update\ChannelsActionBuilder;

class ActionBuilder
{
    /**
     * @return CustomersActionBuilder
     */
    public function customers()
    {
        return new CustomersActionBuilder();
    }

    /**
     * @return ProductTypesActionBuilder
     */
    public function productTypes()
    {
        return new ProductTypesActionBuilder();
    }

    /**
     * @return TaxCategoriesActionBuilder
     */
    public function taxCategories()
    {
        return new TaxCategoriesActionBuilder();
    }

    /**
     * @return DiscountCodesActionBuilder
     */
    public function discountCodes()
    {
        return new DiscountCodesActionBuilder();
    }

    /**
     * @return PaymentsActionBuilder
     */
    public function payments()
    {
        return new PaymentsActionBuilder();
    }

    /**
     * @return TypesActionBuilder
     */
    public function types()
    {
        return new TypesActionBuilder();
    }

    /**
     * @return ProductsActionBuilder
     */
    public function products()
    {
        return new ProductsActionBuilder();
    }

    /**
     * @return ZonesActionBuilder
     */
    public function zones()
    {
        return new ZonesActionBuilder();
    }

    /**
     * @return CustomFieldActionBuilder
     */
    public function customField()
    {
        return new CustomFieldActionBuilder();
    }

    /**
     * @return CustomerGroupsActionBuilder
     */
    public function customerGroups()
    {
        return new CustomerGroupsActionBuilder();
    }

    /**
     * @return ShippingMethodsActionBuilder
     */
    public function shippingMethods()
    {
        return new ShippingMethodsActionBuilder();
    }

    /**
     * @return ShoppingListsActionBuilder
     */
    public function shoppingLists()
    {
        return new ShoppingListsActionBuilder();
    }

    /**
     * @return SubscriptionsActionBuilder
     */
    public function subscriptions()
    {
        return new SubscriptionsActionBuilder();
    }

    /**
     * @return ProjectActionBuilder
     */
    public function project()
    {
        return new ProjectActionBuilder();
    }

    /**
     * @return CartsActionBuilder
     */
    public function carts()
    {
        return new CartsActionBuilder();
    }

    /**
     * @return InventoryActionBuilder
     */
    public function inventory()
    {
        return new InventoryActionBuilder();
    }

    /**
     * @return StatesActionBuilder
     */
    public function states()
    {
        return new StatesActionBuilder();
    }

    /**
     * @return OrdersActionBuilder
     */
    public function orders()
    {
        return new OrdersActionBuilder();
    }

    /**
     * @return ProductDiscountsActionBuilder
     */
    public function productDiscounts()
    {
        return new ProductDiscountsActionBuilder();
    }

    /**
     * @return CategoriesActionBuilder
     */
    public function categories()
    {
        return new CategoriesActionBuilder();
    }

    /**
     * @return CartDiscountsActionBuilder
     */
    public function cartDiscounts()
    {
        return new CartDiscountsActionBuilder();
    }

    /**
     * @return ReviewsActionBuilder
     */
    public function reviews()
    {
        return new ReviewsActionBuilder();
    }

    /**
     * @return ChannelsActionBuilder
     */
    public function channels()
    {
        return new ChannelsActionBuilder();
    }

    /**
     * @return ActionBuilder
     */
    public static function of()
    {
        return new self();
    }
}
