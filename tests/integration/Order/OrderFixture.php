<?php

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ApiServiceException;
use Commercetools\Core\Error\BadRequestException;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\Cart\CartFixture;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\ShippingMethod\ShippingMethodFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\IntegrationTests\TaxCategory\TaxCategoryFixture;
use Commercetools\Core\IntegrationTests\Zone\ZoneFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraftCollection;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Model\Zone\ZoneReference;
use Commercetools\Core\Request\Carts\Command\CartRecalculateAction;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;

class OrderFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = OrderCreateFromCartRequest::class;
    const DELETE_REQUEST_TYPE = OrderDeleteRequest::class;

    final public static function uniqueOrderString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCartDraftBuilderFunction(CartDraft $cartDraft)
    {
        return $cartDraft;
    }

    final public static function defaultOrderRequestBuilderFunction(OrderCreateFromCartRequest $request)
    {
        return $request;
    }

    final public static function defaultOrderRequestDraftFunction(Cart $cart)
    {
        return RequestBuilder::of()->orders()->createFromCart($cart);
    }

    public static function defaultOrderCreateFunction(ApiClient $client, $request)
    {
        try {
            $response = $client->execute($request);
        } catch (ApiServiceException $e) {
            throw self::toFixtureException($e);
        }
        $result = $request->mapFromResponse($response);

        return $result;
    }

    final public static function defaultOrderDeleteFunction(ApiClient $client, Order $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableCartOrderAddingTwoProducts(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withUpdateableCartDraftOrderAddingTwoProducts(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            [__CLASS__, 'defaultOrderRequestBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withUpdateableCartDraftOrderAddingTwoProducts(
        ApiClient $client,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withOrderResourceAddingTwoProducts(
            $client,
            function ($client, $deleteFunction, $assertFunction, $resource, $customer, $product1, $product2, $cart, $shippingMethod) {
                $updatedResource = null;
                try {
                    $updatedResource = call_user_func($assertFunction, $resource, $customer, $product1, $product2, $cart, $shippingMethod);
                } finally {
                    call_user_func($deleteFunction, $client, $updatedResource != null ? $updatedResource : $resource);
                }
            },
            $cartDraftBuilderFunction,
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withUpdateableCartDraftOrderSetting(
        ApiClient $client,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withUpdateableCartDraftSetting(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withUpdateableCartDraftSetting(
        ApiClient $client,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withOrderResourceCartDraftSetting(
            $client,
            function ($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod) {
                $updatedResource = null;
                try {
                    $updatedResource = call_user_func($assertFunction, $resource, $customer, $product, $cart, $shippingMethod);
                } finally {
                    call_user_func($deleteFunction, $client, $updatedResource != null ? $updatedResource : $resource);
                }
            },
            $cartDraftBuilderFunction,
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withUpdateableCartDraftOrder(
        ApiClient $client,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withOrderResource(
            $client,
            function ($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod) {
                $updatedResource = null;
                try {
                    $updatedResource = call_user_func($assertFunction, $resource, $customer, $product, $cart, $shippingMethod);
                } finally {
                    call_user_func($deleteFunction, $client, $updatedResource != null ? $updatedResource : $resource);
                }
            },
            $cartDraftBuilderFunction,
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withCartDraftOrder(
        ApiClient $client,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withOrderResource(
            $client,
            function ($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod) {
                try {
                    call_user_func($assertFunction, $resource, $customer, $product, $cart, $shippingMethod);
                } finally {
                    call_user_func($deleteFunction, $client, $resource);
                }
            },
            $cartDraftBuilderFunction,
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withStoreCartDraftOrder(
        ApiClient $client,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        StoreFixture::withStore($client, function (Store $store) use (
            $client,
            $cartDraftBuilderFunction,
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        ) {
            self::withOrderResource(
                $client,
                function ($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod) use ($store) {
                    try {
                        call_user_func($assertFunction, $resource, $store, $customer, $product, $cart, $shippingMethod);
                    } finally {
                        call_user_func($deleteFunction, $client, $resource);
                    }
                },
                $cartDraftBuilderFunction,
                $orderRequestBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $orderRequestDraftFunction,
                StoreReference::ofId($store->getId())
            );
        });
    }

    final public static function withUpdateableOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withUpdateableCartDraftOrder(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            [__CLASS__, 'defaultOrderRequestBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withUpdateableDraftOrder(
        ApiClient $client,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withUpdateableCartDraftOrder(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withCartDraftOrder(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            [__CLASS__, 'defaultOrderRequestBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withDraftOrder(
        ApiClient $client,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withCartDraftOrder(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $orderRequestBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    final public static function withStoreOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null
    ) {
        self::withStoreCartDraftOrder(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            [__CLASS__, 'defaultOrderRequestBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $orderRequestDraftFunction
        );
    }

    private static function withOrderResource(
        ApiClient $client,
        callable $fixtureFunction,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null,
        $storeReference = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rates = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rates);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $cartDraftBuilderFunction,
                $orderRequestBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $orderRequestDraftFunction,
                $region,
                $fixtureFunction,
                $storeReference
            ) {
                ZoneFixture::withDraftZone(
                    $client,
                    function (ZoneDraft $zoneDraft) use ($region) {
                        return $zoneDraft->setLocations(
                            LocationCollection::of()->add(
                                Location::of()->setCountry('DE')->setState($region)
                            )
                        );
                    },
                    function (Zone $zone) use (
                        $client,
                        $cartDraftBuilderFunction,
                        $orderRequestBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $orderRequestDraftFunction,
                        $taxCategory,
                        $region,
                        $fixtureFunction,
                        $storeReference
                    ) {
                        ShippingMethodFixture::withDraftShippingMethod(
                            $client,
                            function (ShippingMethodDraft $shippingMethodDraft) use ($taxCategory, $zone) {
                                return $shippingMethodDraft->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()))
                                    ->setZoneRates(ZoneRateCollection::of()->add(
                                        ZoneRate::of()->setZone(ZoneReference::ofId($zone->getId()))
                                            ->setShippingRates(
                                                ShippingRateCollection::of()->add(
                                                    ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                                                )
                                            )
                                    ));
                            },
                            function (ShippingMethod $shippingMethod) use (
                                $client,
                                $taxCategory,
                                $cartDraftBuilderFunction,
                                $orderRequestBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $orderRequestDraftFunction,
                                $region,
                                $fixtureFunction,
                                $storeReference
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $productDraft) use ($taxCategory) {
                                        return $productDraft
                                            ->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product) use (
                                        $client,
                                        $taxCategory,
                                        $cartDraftBuilderFunction,
                                        $orderRequestBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $orderRequestDraftFunction,
                                        $shippingMethod,
                                        $region,
                                        $fixtureFunction,
                                        $storeReference
                                    ) {
                                        CustomerFixture::withDraftCustomer(
                                            $client,
                                            function (CustomerDraft $customerDraft) use ($region, $storeReference) {
                                                $customerDraft
                                                    ->setAddresses(
                                                        AddressCollection::of()->add(
                                                            Address::of()
                                                                ->setCountry('DE')
                                                                ->setState($region)
                                                                ->setKey('key-' . CustomerFixture::uniqueCustomerString())
                                                        )
                                                    )
                                                    ->setDefaultBillingAddress(0)
                                                    ->setDefaultShippingAddress(0);
                                                if ($storeReference != null) {
                                                    $customerDraft->setStores(StoreReferenceCollection::of()->add($storeReference));
                                                }
                                                return $customerDraft;
                                            },
                                            function (Customer $customer) use (
                                                $client,
                                                $shippingMethod,
                                                $cartDraftBuilderFunction,
                                                $orderRequestBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $orderRequestDraftFunction,
                                                $product,
                                                $fixtureFunction,
                                                $storeReference
                                            ) {
                                                CartFixture::withUpdateableDraftCart(
                                                    $client,
                                                    $cartDraftBuilderFunction,
                                                    function (Cart $cart) use (
                                                        $client,
                                                        $orderRequestBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $orderRequestDraftFunction,
                                                        $product,
                                                        $customer,
                                                        $shippingMethod,
                                                        $fixtureFunction
                                                    ) {
                                                        if ($orderRequestDraftFunction == null) {
                                                            $orderRequestDraftFunction = [__CLASS__, 'defaultOrderRequestDraftFunction'];
                                                        }
                                                        if ($createFunction == null) {
                                                            $createFunction = [__CLASS__, 'defaultOrderCreateFunction'];
                                                        }
                                                        if ($deleteFunction == null) {
                                                            $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                        }

                                                        $orderFromCartDraftRequest = call_user_func($orderRequestDraftFunction, $cart);

                                                        $orderFromCartRequest = call_user_func($orderRequestBuilderFunction, $orderFromCartDraftRequest);

                                                        try {
                                                            $resource = $createFunction($client, $orderFromCartRequest);
                                                        } catch (BadRequestException $e) {
                                                            $request = RequestBuilder::of()->carts()->update($cart)
                                                                ->addAction(CartRecalculateAction::of());
                                                            $response = $client->execute($request);
                                                            $cart = $request->mapFromResponse($response);

                                                            $orderFromCartDraftRequest = call_user_func($orderRequestDraftFunction, $cart);
                                                            $orderFromCartRequest = call_user_func($orderRequestBuilderFunction, $orderFromCartDraftRequest);
                                                            $resource = $createFunction($client, $orderFromCartRequest);
                                                        }

                                                        $fixtureFunction($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod);

                                                        return $cart;
                                                    },
                                                    null,
                                                    null,
                                                    function () use ($customer, $shippingMethod, $product, $storeReference) {
                                                        $cartDraft = CartFixture::customerCartDraftFunction($customer, $shippingMethod);
                                                        $cartDraft->setLineItems(
                                                            LineItemDraftCollection::of()
                                                                ->add(
                                                                    LineItemDraft::ofProductIdVariantIdAndQuantity($product->getId(), 1, 1)
                                                                )
                                                        );
                                                        if ($storeReference != null) {
                                                            $cartDraft->setStore($storeReference);
                                                        }

                                                        return $cartDraft;
                                                    }
                                                );
                                            }
                                        );
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }

    private static function withOrderResourceCartDraftSetting(
        ApiClient $client,
        callable $fixtureFunction,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null,
        $storeReference = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rates = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rates);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $cartDraftBuilderFunction,
                $orderRequestBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $orderRequestDraftFunction,
                $region,
                $fixtureFunction,
                $storeReference
            ) {
                ZoneFixture::withDraftZone(
                    $client,
                    function (ZoneDraft $zoneDraft) use ($region) {
                        return $zoneDraft->setLocations(
                            LocationCollection::of()->add(
                                Location::of()->setCountry('DE')->setState($region)
                            )
                        );
                    },
                    function (Zone $zone) use (
                        $client,
                        $cartDraftBuilderFunction,
                        $orderRequestBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $orderRequestDraftFunction,
                        $taxCategory,
                        $region,
                        $fixtureFunction,
                        $storeReference
                    ) {
                        ShippingMethodFixture::withDraftShippingMethod(
                            $client,
                            function (ShippingMethodDraft $shippingMethodDraft) use ($taxCategory, $zone) {
                                return $shippingMethodDraft->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()))
                                    ->setZoneRates(ZoneRateCollection::of()->add(
                                        ZoneRate::of()->setZone(ZoneReference::ofId($zone->getId()))
                                            ->setShippingRates(
                                                ShippingRateCollection::of()->add(
                                                    ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                                                )
                                            )
                                    ));
                            },
                            function (ShippingMethod $shippingMethod) use (
                                $client,
                                $taxCategory,
                                $cartDraftBuilderFunction,
                                $orderRequestBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $orderRequestDraftFunction,
                                $region,
                                $fixtureFunction,
                                $storeReference
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $productDraft) use ($taxCategory) {
                                        return $productDraft
                                            ->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product) use (
                                        $client,
                                        $taxCategory,
                                        $cartDraftBuilderFunction,
                                        $orderRequestBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $orderRequestDraftFunction,
                                        $shippingMethod,
                                        $region,
                                        $fixtureFunction,
                                        $storeReference
                                    ) {
                                        CustomerFixture::withDraftCustomer(
                                            $client,
                                            function (CustomerDraft $customerDraft) use ($region, $storeReference) {
                                                $customerDraft
                                                    ->setAddresses(
                                                        AddressCollection::of()->add(
                                                            Address::of()
                                                                ->setCountry('DE')
                                                                ->setState($region)
                                                                ->setKey('key-' . CustomerFixture::uniqueCustomerString())
                                                        )
                                                    )
                                                    ->setDefaultBillingAddress(0)
                                                    ->setDefaultShippingAddress(0);
                                                if ($storeReference != null) {
                                                    $customerDraft->setStores(StoreReferenceCollection::of()->add($storeReference));
                                                }
                                                return $customerDraft;
                                            },
                                            function (Customer $customer) use (
                                                $client,
                                                $shippingMethod,
                                                $cartDraftBuilderFunction,
                                                $orderRequestBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $orderRequestDraftFunction,
                                                $product,
                                                $fixtureFunction,
                                                $storeReference
                                            ) {
                                                CartFixture::withDraftCart(
                                                    $client,
                                                    $cartDraftBuilderFunction,
                                                    function (Cart $cart) use (
                                                        $client,
                                                        $orderRequestBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $orderRequestDraftFunction,
                                                        $product,
                                                        $customer,
                                                        $shippingMethod,
                                                        $fixtureFunction
                                                    ) {
                                                        if ($orderRequestDraftFunction == null) {
                                                            $orderRequestDraftFunction = [__CLASS__, 'defaultOrderRequestDraftFunction'];
                                                        }
                                                        if ($createFunction == null) {
                                                            $createFunction = [__CLASS__, 'defaultOrderCreateFunction'];
                                                        }
                                                        if ($deleteFunction == null) {
                                                            $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                        }

                                                        $orderFromCartDraftRequest = call_user_func($orderRequestDraftFunction, $cart);

                                                        $orderFromCartRequest = call_user_func($orderRequestBuilderFunction, $orderFromCartDraftRequest);

                                                        $resource = $createFunction($client, $orderFromCartRequest);

                                                        $fixtureFunction($client, $deleteFunction, $assertFunction, $resource, $customer, $product, $cart, $shippingMethod);
                                                    },
                                                    null,
                                                    null,
                                                    function () use ($customer, $shippingMethod, $product, $storeReference) {
                                                        $cartDraft = CartFixture::customerCartDraftFunction($customer, $shippingMethod);
                                                        $cartDraft->setItemShippingAddresses(
                                                            AddressCollection::of()->add(
                                                                Address::of()->setCountry('DE')->setKey('key1')
                                                            )
                                                        )->setLineItems(
                                                            LineItemDraftCollection::of()
                                                                ->add(
                                                                    LineItemDraft::ofProductIdVariantIdAndQuantity($product->getId(), 1, 10)
                                                                )
                                                        )->setCustomLineItems(
                                                            CustomLineItemDraftCollection::of()->add(
                                                                CustomLineItemDraft::ofNameMoneySlugTaxCategoryAndQuantity(
                                                                    LocalizedString::ofLangAndText('en', 'test'),
                                                                    Money::ofCurrencyAndAmount('EUR', 100),
                                                                    'test',
                                                                    $shippingMethod->getTaxCategory(),
                                                                    10
                                                                )
                                                            )
                                                        );
                                                        if ($storeReference != null) {
                                                            $cartDraft->setStore($storeReference);
                                                        }

                                                        return $cartDraft;
                                                    }
                                                );
                                            }
                                        );
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }

    private static function withOrderResourceAddingTwoProducts(
        ApiClient $client,
        callable $fixtureFunction,
        callable $cartDraftBuilderFunction,
        callable $orderRequestBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $orderRequestDraftFunction = null,
        $storeReference = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rates = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rates);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $cartDraftBuilderFunction,
                $orderRequestBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $orderRequestDraftFunction,
                $region,
                $fixtureFunction,
                $storeReference
            ) {
                ZoneFixture::withDraftZone(
                    $client,
                    function (ZoneDraft $zoneDraft) use ($region) {
                        return $zoneDraft->setLocations(
                            LocationCollection::of()->add(
                                Location::of()->setCountry('DE')->setState($region)
                            )
                        );
                    },
                    function (Zone $zone) use (
                        $client,
                        $cartDraftBuilderFunction,
                        $orderRequestBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $orderRequestDraftFunction,
                        $taxCategory,
                        $region,
                        $fixtureFunction,
                        $storeReference
                    ) {
                        ShippingMethodFixture::withDraftShippingMethod(
                            $client,
                            function (ShippingMethodDraft $shippingMethodDraft) use ($taxCategory, $zone) {
                                return $shippingMethodDraft->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()))
                                    ->setZoneRates(ZoneRateCollection::of()->add(
                                        ZoneRate::of()->setZone(ZoneReference::ofId($zone->getId()))
                                            ->setShippingRates(
                                                ShippingRateCollection::of()->add(
                                                    ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                                                )
                                            )
                                    ));
                            },
                            function (ShippingMethod $shippingMethod) use (
                                $client,
                                $taxCategory,
                                $cartDraftBuilderFunction,
                                $orderRequestBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $orderRequestDraftFunction,
                                $region,
                                $fixtureFunction,
                                $storeReference
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $product1Draft) use ($taxCategory) {
                                        return $product1Draft
                                            ->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product1) use (
                                        $client,
                                        $taxCategory,
                                        $cartDraftBuilderFunction,
                                        $orderRequestBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $orderRequestDraftFunction,
                                        $shippingMethod,
                                        $region,
                                        $fixtureFunction,
                                        $storeReference
                                    ) {
                                        ProductFixture::withDraftProduct(
                                            $client,
                                            function (ProductDraft $product2Draft) use ($taxCategory) {
                                                return $product2Draft->setMasterVariant(
                                                    ProductVariantDraft::ofSkuAndPrices(
                                                        'test-' . ProductFixture::uniqueProductString() . '-sku2',
                                                        PriceDraftCollection::of()->add(
                                                            PriceDraft::ofMoneyAndCountry(
                                                                Money::ofCurrencyAndAmount('EUR', 100),
                                                                'DE'
                                                            )
                                                        )
                                                    )
                                                )->setPublish(true)
                                                        ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                            },
                                            function (Product $product2) use (
                                                $client,
                                                $taxCategory,
                                                $cartDraftBuilderFunction,
                                                $orderRequestBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $orderRequestDraftFunction,
                                                $shippingMethod,
                                                $region,
                                                $fixtureFunction,
                                                $storeReference,
                                                $product1
                                            ) {
                                                CustomerFixture::withDraftCustomer(
                                                    $client,
                                                    function (CustomerDraft $customerDraft) use ($region, $storeReference) {
                                                        $customerDraft
                                                            ->setAddresses(
                                                                AddressCollection::of()->add(
                                                                    Address::of()
                                                                        ->setCountry('DE')
                                                                        ->setState($region)
                                                                        ->setKey('key-' . CustomerFixture::uniqueCustomerString())
                                                                )
                                                            )
                                                            ->setDefaultBillingAddress(0)
                                                            ->setDefaultShippingAddress(0);
                                                        if ($storeReference != null) {
                                                            $customerDraft->setStores(StoreReferenceCollection::of()->add($storeReference));
                                                        }
                                                        return $customerDraft;
                                                    },
                                                    function (Customer $customer) use (
                                                        $client,
                                                        $shippingMethod,
                                                        $cartDraftBuilderFunction,
                                                        $orderRequestBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $orderRequestDraftFunction,
                                                        $product1,
                                                        $product2,
                                                        $fixtureFunction,
                                                        $storeReference
                                                    ) {
                                                        CartFixture::withDraftCart(
                                                            $client,
                                                            $cartDraftBuilderFunction,
                                                            function (Cart $cart) use (
                                                                $client,
                                                                $orderRequestBuilderFunction,
                                                                $assertFunction,
                                                                $createFunction,
                                                                $deleteFunction,
                                                                $orderRequestDraftFunction,
                                                                $product1,
                                                                $product2,
                                                                $customer,
                                                                $shippingMethod,
                                                                $fixtureFunction
                                                            ) {
                                                                if ($orderRequestDraftFunction == null) {
                                                                    $orderRequestDraftFunction = [__CLASS__, 'defaultOrderRequestDraftFunction'];
                                                                }
                                                                if ($createFunction == null) {
                                                                    $createFunction = [__CLASS__, 'defaultOrderCreateFunction'];
                                                                }
                                                                if ($deleteFunction == null) {
                                                                    $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                                }

                                                                $orderFromCartDraftRequest = call_user_func($orderRequestDraftFunction, $cart);

                                                                $orderFromCartRequest = call_user_func($orderRequestBuilderFunction, $orderFromCartDraftRequest);

                                                                $resource = $createFunction($client, $orderFromCartRequest);

                                                                $fixtureFunction($client, $deleteFunction, $assertFunction, $resource, $customer, $product1, $product2, $cart, $shippingMethod);
                                                            },
                                                            null,
                                                            null,
                                                            function () use ($customer, $shippingMethod, $product1, $product2, $storeReference) {
                                                                $cartDraft = CartFixture::customerCartDraftFunction($customer, $shippingMethod);

                                                                $cartDraft->setLineItems(
                                                                    LineItemDraftCollection::of()
                                                                        ->add(
                                                                            LineItemDraft::ofProductIdVariantIdAndQuantity($product1->getId(), 1, 1)
                                                                        )->add(LineItemDraft::ofSkuAndQuantity(
                                                                            $product2->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                                                                            1
                                                                        ))
                                                                );

                                                                $cartDraft->setCustomLineItems(
                                                                    CustomLineItemDraftCollection::of()->add(
                                                                        CustomLineItemDraft::ofNameMoneySlugTaxCategoryAndQuantity(
                                                                            LocalizedString::ofLangAndText('en', 'test'),
                                                                            Money::ofCurrencyAndAmount('EUR', 100),
                                                                            'test',
                                                                            $shippingMethod->getTaxCategory(),
                                                                            1
                                                                        )
                                                                    )
                                                                );
                                                                if ($storeReference != null) {
                                                                    $cartDraft->setStore($storeReference);
                                                                }

                                                                return $cartDraft;
                                                            }
                                                        );
                                                    }
                                                );
                                            }
                                        );
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }
}
