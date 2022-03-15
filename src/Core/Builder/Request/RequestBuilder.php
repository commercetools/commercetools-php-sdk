<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\PsrRequest;
use Psr\Http\Message\RequestInterface;

class RequestBuilder
{
    /**
     * @return ApiClientRequestBuilder
     */
    public function apiClients()
    {
        return new ApiClientRequestBuilder();
    }

    /**
     * @return CartDiscountRequestBuilder
     */
    public function cartDiscounts()
    {
        return new CartDiscountRequestBuilder();
    }

    /**
     * @return CartRequestBuilder
     */
    public function carts()
    {
        return new CartRequestBuilder();
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
     * @return CustomObjectRequestBuilder
     */
    public function customObjects()
    {
        return new CustomObjectRequestBuilder();
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
     * @return DiscountCodeRequestBuilder
     */
    public function discountCodes()
    {
        return new DiscountCodeRequestBuilder();
    }

    /**
     * @return ExtensionRequestBuilder
     */
    public function extensions()
    {
        return new ExtensionRequestBuilder();
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
     * @return MeRequestBuilder
     */
    public function me()
    {
        return new MeRequestBuilder();
    }

    /**
     * @return MessageRequestBuilder
     */
    public function messages()
    {
        return new MessageRequestBuilder();
    }

    /**
     * @return OrderEditRequestBuilder
     */
    public function orderEdits()
    {
        return new OrderEditRequestBuilder();
    }

    /**
     * @return OrderSearchRequestBuilder
     */
    public function orderSearch()
    {
        return new OrderSearchRequestBuilder();
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
     * @return ProductProjectionRequestBuilder
     */
    public function productProjections()
    {
        return new ProductProjectionRequestBuilder();
    }

    /**
     * @return ProductSelectionRequestBuilder
     */
    public function productSelections()
    {
        return new ProductSelectionRequestBuilder();
    }

    /**
     * @return ProductTypeRequestBuilder
     */
    public function productTypes()
    {
        return new ProductTypeRequestBuilder();
    }

    /**
     * @return ProductRequestBuilder
     */
    public function products()
    {
        return new ProductRequestBuilder();
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
     * @return StoreRequestBuilder
     */
    public function stores()
    {
        return new StoreRequestBuilder();
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
     * @param RequestInterface $request
     * @return PsrRequest
     */
    public function request(RequestInterface $request)
    {
        return PsrRequest::ofRequest($request);
    }

    /**
     * @return RequestBuilder
     */
    public static function of()
    {
        return new self();
    }
}
