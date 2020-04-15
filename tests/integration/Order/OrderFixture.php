<?php

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ApiServiceException;
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
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
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

    final public static function orderDraftFunction(Cart $draft)
    {
        return $draft;
    }

    final public static function defaultOrderDraftBuilderFunction($draft)
    {
        return $draft;
    }

    public static function orderCreateFunction(
        ApiClient $client,
        Cart $cart
    ) {
        $request = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
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

    final public static function withUpdateableDraftCartOrder(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rate = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rate);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction,
                $region
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
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction,
                        $taxCategory,
                        $region
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
                                $draftBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $draftFunction,
                                $region
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $productDraft) use ($taxCategory) {
                                        return $productDraft->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product) use (
                                        $client,
                                        $taxCategory,
                                        $draftBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $draftFunction,
                                        $shippingMethod,
                                        $region
                                    ) {
                                        CustomerFixture::withDraftCustomer(
                                            $client,
                                            function (CustomerDraft $customerDraft) use ($region) {
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

                                                return $customerDraft;
                                            },
                                            function (Customer $customer) use (
                                                $client,
                                                $shippingMethod,
                                                $draftBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $draftFunction,
                                                $product
                                            ) {
                                                CartFixture::withDraftCart(
                                                    $client,
                                                    function (CartDraft $cartDraft) use ($customer, $product, $shippingMethod) {
                                                        $cartDraft->setCustomerId($customer->getId())
                                                            ->setShippingAddress($customer->getDefaultShippingAddress())
                                                            ->setBillingAddress($customer->getDefaultBillingAddress())
                                                            ->setCustomerEmail($customer->getEmail())
                                                            ->setLineItems(
                                                                LineItemDraftCollection::of()
                                                                    ->add(
                                                                        LineItemDraft::ofProductIdVariantIdAndQuantity($product->getId(), 1, 1)
                                                                    )
                                                            )
                                                            ->setShippingMethod(ShippingMethodReference::ofId($shippingMethod->getId()));

                                                        return $cartDraft;
                                                    },
                                                    function (Cart $cart) use (
                                                        $client,
                                                        $draftBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $draftFunction,
                                                        $product,
                                                        $customer,
                                                        $shippingMethod
                                                    ) {
                                                        if ($draftFunction == null) {
                                                            $draftFunction = function () use ($cart) {
                                                                return call_user_func(
                                                                    [__CLASS__, 'orderDraftFunction'],
                                                                    $cart
                                                                );
                                                            };
                                                        } else {
                                                            $draftFunction = function () use (
                                                                $cart,
                                                                $draftFunction
                                                            ) {
                                                                return call_user_func($draftFunction, $cart);
                                                            };
                                                        }
                                                        if ($createFunction == null) {
                                                            $createFunction = [__CLASS__, 'orderCreateFunction'];
                                                        }
                                                        if ($deleteFunction == null) {
                                                            $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                        }

                                                        parent::withUpdateableDraftResource(
                                                            $client,
                                                            $draftBuilderFunction,
                                                            $assertFunction,
                                                            $createFunction,
                                                            $deleteFunction,
                                                            $draftFunction,
                                                            [$customer, $product, $cart, $shippingMethod]
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



    final public static function withDraftCartOrder(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rate = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rate);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction,
                $region
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
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction,
                        $taxCategory,
                        $region
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
                                $draftBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $draftFunction,
                                $region
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $productDraft) use ($taxCategory) {
                                        return $productDraft->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product) use (
                                        $client,
                                        $taxCategory,
                                        $draftBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $draftFunction,
                                        $shippingMethod,
                                        $region
                                    ) {
                                        CustomerFixture::withDraftCustomer(
                                            $client,
                                            function (CustomerDraft $customerDraft) use ($region) {
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

                                                return $customerDraft;
                                            },
                                            function (Customer $customer) use (
                                                $client,
                                                $shippingMethod,
                                                $draftBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $draftFunction,
                                                $product
                                            ) {
                                                CartFixture::withDraftCart(
                                                    $client,
                                                    function (CartDraft $cartDraft) use ($customer, $product, $shippingMethod) {
                                                        $cartDraft->setCustomerId($customer->getId())
                                                            ->setShippingAddress($customer->getDefaultShippingAddress())
                                                            ->setBillingAddress($customer->getDefaultBillingAddress())
                                                            ->setCustomerEmail($customer->getEmail())
                                                            ->setLineItems(
                                                                LineItemDraftCollection::of()
                                                                    ->add(
                                                                        LineItemDraft::ofProductIdVariantIdAndQuantity($product->getId(), 1, 1)
                                                                    )
                                                            )
                                                            ->setShippingMethod(ShippingMethodReference::ofId($shippingMethod->getId()));

                                                        return $cartDraft;
                                                    },
                                                    function (Cart $cart) use (
                                                        $client,
                                                        $draftBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $draftFunction,
                                                        $product,
                                                        $customer,
                                                        $shippingMethod
                                                    ) {
                                                        if ($draftFunction == null) {
                                                            $draftFunction = function () use ($cart) {
                                                                return call_user_func(
                                                                    [__CLASS__, 'orderDraftFunction'],
                                                                    $cart
                                                                );
                                                            };
                                                        } else {
                                                            $draftFunction = function () use (
                                                                $cart,
                                                                $draftFunction
                                                            ) {
                                                                return call_user_func($draftFunction, $cart);
                                                            };
                                                        }
                                                        if ($createFunction == null) {
                                                            $createFunction = [__CLASS__, 'orderCreateFunction'];
                                                        }
                                                        if ($deleteFunction == null) {
                                                            $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                        }

                                                        parent::withDraftResource(
                                                            $client,
                                                            $draftBuilderFunction,
                                                            $assertFunction,
                                                            $createFunction,
                                                            $deleteFunction,
                                                            $draftFunction,
                                                            [$customer, $product, $cart, $shippingMethod]
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

    final public static function withDraftCartStoreOrder(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        TaxCategoryFixture::withDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $taxCategoryDraft) use ($region) {
                $rate = TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-name')
                        ->setAmount((float)('0.2' . mt_rand(1, 100)))
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($region)
                );
                return $taxCategoryDraft->setRates($rate);
            },
            function (TaxCategory $taxCategory) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction,
                $region
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
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction,
                        $taxCategory,
                        $region
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
                                $draftBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $draftFunction,
                                $region
                            ) {
                                ProductFixture::withDraftProduct(
                                    $client,
                                    function (ProductDraft $productDraft) use ($taxCategory) {
                                        return $productDraft->setPublish(true)
                                            ->setTaxCategory(TaxCategoryReference::ofId($taxCategory->getId()));
                                    },
                                    function (Product $product) use (
                                        $client,
                                        $taxCategory,
                                        $draftBuilderFunction,
                                        $assertFunction,
                                        $createFunction,
                                        $deleteFunction,
                                        $draftFunction,
                                        $shippingMethod,
                                        $region
                                    ) {
                                        StoreFixture::withStore(
                                            $client,
                                            function (Store $store) use (
                                                $client,
                                                $shippingMethod,
                                                $draftBuilderFunction,
                                                $assertFunction,
                                                $createFunction,
                                                $deleteFunction,
                                                $draftFunction,
                                                $product,
                                                $region
                                            ) {
                                                CustomerFixture::withDraftCustomer(
                                                    $client,
                                                    function (CustomerDraft $customerDraft) use ($region, $store) {
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
                                                            ->setDefaultShippingAddress(0)
                                                            ->setStores(StoreReferenceCollection::of()
                                                                ->add(StoreReference::ofKey($store->getKey())));

                                                        return $customerDraft;
                                                    },
                                                    function (Customer $customer) use (
                                                        $client,
                                                        $shippingMethod,
                                                        $draftBuilderFunction,
                                                        $assertFunction,
                                                        $createFunction,
                                                        $deleteFunction,
                                                        $draftFunction,
                                                        $product,
                                                        $store
                                                    ) {
                                                        CartFixture::withDraftCart(
                                                            $client,
                                                            function (CartDraft $cartDraft) use ($customer, $product, $shippingMethod) {
                                                                $cartDraft->setCustomerId($customer->getId())
                                                                    ->setShippingAddress($customer->getDefaultShippingAddress())
                                                                    ->setBillingAddress($customer->getDefaultBillingAddress())
                                                                    ->setCustomerEmail($customer->getEmail())
                                                                    ->setLineItems(
                                                                        LineItemDraftCollection::of()
                                                                            ->add(
                                                                                LineItemDraft::ofProductIdVariantIdAndQuantity($product->getId(), 1, 1)
                                                                            )
                                                                    )
                                                                    ->setShippingMethod(ShippingMethodReference::ofId($shippingMethod->getId()));

                                                                return $cartDraft;
                                                            },
                                                            function (Cart $cart) use (
                                                                $client,
                                                                $draftBuilderFunction,
                                                                $assertFunction,
                                                                $createFunction,
                                                                $deleteFunction,
                                                                $draftFunction,
                                                                $product,
                                                                $customer,
                                                                $shippingMethod,
                                                                $store
                                                            ) {
                                                                if ($draftFunction == null) {
                                                                    $draftFunction = function () use ($cart) {
                                                                        return call_user_func(
                                                                            [__CLASS__, 'orderDraftFunction'],
                                                                            $cart
                                                                        );
                                                                    };
                                                                } else {
                                                                    $draftFunction = function () use (
                                                                        $cart,
                                                                        $draftFunction
                                                                    ) {
                                                                        return call_user_func($draftFunction, $cart);
                                                                    };
                                                                }
                                                                if ($createFunction == null) {
                                                                    $createFunction = [__CLASS__, 'orderCreateFunction'];
                                                                }
                                                                if ($deleteFunction == null) {
                                                                    $deleteFunction = [__CLASS__, 'defaultOrderDeleteFunction'];
                                                                }

                                                                parent::withDraftResource(
                                                                    $client,
                                                                    $draftBuilderFunction,
                                                                    $assertFunction,
                                                                    $createFunction,
                                                                    $deleteFunction,
                                                                    $draftFunction,
                                                                    [$store, $customer, $product, $cart, $shippingMethod]
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
        );
    }


    final public static function withCartOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCartOrder(
            $client,
            [__CLASS__, 'defaultOrderDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withCartStoreOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCartStoreOrder(
            $client,
            [__CLASS__, 'defaultOrderDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCartOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCartOrder(
            $client,
            [__CLASS__, 'defaultOrderDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableStoreOrder(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftStoreOrder(
            $client,
            [__CLASS__, 'defaultOrderDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
