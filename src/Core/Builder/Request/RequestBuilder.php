<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

/**
 *
 */
class RequestBuilder
{
    /**
     * @return CartRequestBuilder
     */
    public function carts()
    {
        return new CartRequestBuilder();
    }

    /**
     * @return CartDiscountRequestBuilder
     */
    public function cartDiscounts()
    {
        return new CartDiscountRequestBuilder();
    }

    /**
     * @return CategoryRequestBuilder
     */
    public function categories()
    {
        return new CategoryRequestBuilder();
    }

    /**
     * @return ChannelRequestBuilder
     */
    public function channels()
    {
        return new ChannelRequestBuilder();
    }

    /**
     * @return CustomerGroupRequestBuilder
     */
    public function customerGroups()
    {
        return new CustomerGroupRequestBuilder();
    }

    /**
     * @return CustomerRequestBuilder
     */
    public function customers()
    {
        return new CustomerRequestBuilder();
    }

    /**
     * @return CustomObjectRequestBuilder
     */
    public function customObjects()
    {
        return new CustomObjectRequestBuilder();
    }

    /**
     * @return DiscountCodeRequestBuilder
     */
    public function discountCodes()
    {
        return new DiscountCodeRequestBuilder();
    }

    /**
     * @return GraphQLRequestBuilder
     */
    public function graphQL()
    {
        return new GraphQLRequestBuilder();
    }

    /**
     * @return InventoryRequestBuilder
     */
    public function inventory()
    {
        return new InventoryRequestBuilder();
    }

    /**
     * @return MessageRequestBuilder
     */
    public function messages()
    {
        return new MessageRequestBuilder();
    }

    /**
     * @return OrderRequestBuilder
     */
    public function orders()
    {
        return new OrderRequestBuilder();
    }

    /**
     * @return PaymentRequestBuilder
     */
    public function payments()
    {
        return new PaymentRequestBuilder();
    }

    /**
     * @return ProductDiscountRequestBuilder
     */
    public function productDiscounts()
    {
        return new ProductDiscountRequestBuilder();
    }

    /**
     * @return ProductRequestBuilder
     */
    public function products()
    {
        return new ProductRequestBuilder();
    }

    /**
     * @return ProductTypeRequestBuilder
     */
    public function productTypes()
    {
        return new ProductTypeRequestBuilder();
    }

    /**
     * @return ProjectRequestBuilder
     */
    public function project()
    {
        return new ProjectRequestBuilder();
    }

    /**
     * @return ReviewRequestBuilder
     */
    public function reviews()
    {
        return new ReviewRequestBuilder();
    }

    /**
     * @return ShippingMethodRequestBuilder
     */
    public function shippingMethods()
    {
        return new ShippingMethodRequestBuilder();
    }

    /**
     * @return ShoppingListRequestBuilder
     */
    public function shoppingLists()
    {
        return new ShoppingListRequestBuilder();
    }

    /**
     * @return StateRequestBuilder
     */
    public function states()
    {
        return new StateRequestBuilder();
    }

    /**
     * @return SubscriptionRequestBuilder
     */
    public function subscriptions()
    {
        return new SubscriptionRequestBuilder();
    }

    /**
     * @return TaxCategoryRequestBuilder
     */
    public function taxCategories()
    {
        return new TaxCategoryRequestBuilder();
    }

    /**
     * @return TypeRequestBuilder
     */
    public function types()
    {
        return new TypeRequestBuilder();
    }

    /**
     * @return ZoneRequestBuilder
     */
    public function zones()
    {
        return new ZoneRequestBuilder();
    }

    /**
     * @return RequestBuilder
     */
    public static function of()
    {
        return new self();
    }
}
