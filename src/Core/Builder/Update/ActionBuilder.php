<?php

namespace Commercetools\Core\Builder\Update;

class ActionBuilder
{
    /**
     * @return CartDiscountsActionBuilder
     */
    public function cartDiscounts()
    {
        return new CartDiscountsActionBuilder();
    }

    /**
     * @return CartsActionBuilder
     */
    public function carts()
    {
        return new CartsActionBuilder();
    }

    /**
     * @return CategoriesActionBuilder
     */
    public function categories()
    {
        return new CategoriesActionBuilder();
    }

    /**
     * @return ChannelsActionBuilder
     */
    public function channels()
    {
        return new ChannelsActionBuilder();
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
     * @return CustomersActionBuilder
     */
    public function customers()
    {
        return new CustomersActionBuilder();
    }

    /**
     * @return DiscountCodesActionBuilder
     */
    public function discountCodes()
    {
        return new DiscountCodesActionBuilder();
    }

    /**
     * @return ExtensionsActionBuilder
     */
    public function extensions()
    {
        return new ExtensionsActionBuilder();
    }

    /**
     * @return InventoryActionBuilder
     */
    public function inventory()
    {
        return new InventoryActionBuilder();
    }

    /**
     * @return OrderEditsActionBuilder
     */
    public function orderEdits()
    {
        return new OrderEditsActionBuilder();
    }

    /**
     * @return OrdersActionBuilder
     */
    public function orders()
    {
        return new OrdersActionBuilder();
    }

    /**
     * @return PaymentsActionBuilder
     */
    public function payments()
    {
        return new PaymentsActionBuilder();
    }

    /**
     * @return ProductDiscountsActionBuilder
     */
    public function productDiscounts()
    {
        return new ProductDiscountsActionBuilder();
    }

    /**
     * @return ProductTypesActionBuilder
     */
    public function productTypes()
    {
        return new ProductTypesActionBuilder();
    }

    /**
     * @return ProductsActionBuilder
     */
    public function products()
    {
        return new ProductsActionBuilder();
    }

    /**
     * @return ProjectActionBuilder
     */
    public function project()
    {
        return new ProjectActionBuilder();
    }

    /**
     * @return ReviewsActionBuilder
     */
    public function reviews()
    {
        return new ReviewsActionBuilder();
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
     * @return StagedOrderActionBuilder
     */
    public function stagedOrder()
    {
        return new StagedOrderActionBuilder();
    }

    /**
     * @return StatesActionBuilder
     */
    public function states()
    {
        return new StatesActionBuilder();
    }

    /**
     * @return StoresActionBuilder
     */
    public function stores()
    {
        return new StoresActionBuilder();
    }

    /**
     * @return SubscriptionsActionBuilder
     */
    public function subscriptions()
    {
        return new SubscriptionsActionBuilder();
    }

    /**
     * @return TaxCategoriesActionBuilder
     */
    public function taxCategories()
    {
        return new TaxCategoriesActionBuilder();
    }

    /**
     * @return TypesActionBuilder
     */
    public function types()
    {
        return new TypesActionBuilder();
    }

    /**
     * @return ZonesActionBuilder
     */
    public function zones()
    {
        return new ZonesActionBuilder();
    }

    /**
     * @return ActionBuilder
     */
    public static function of()
    {
        return new self();
    }
}
