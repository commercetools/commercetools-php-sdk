<?php

namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ApiServiceException;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\Inventory\InventoryFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Model\Order\LineItemImportDraft;
use Commercetools\Core\Model\Order\LineItemImportDraftCollection;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\ProductVariantImportDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderImportRequest;

class OrderImportFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = OrderImportRequest::class;
    const DELETE_REQUEST_TYPE = OrderDeleteRequest::class;

    final public static function uniqueOrderImportString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function orderImportDraftFunction(Customer $customer, Product $product, StoreReference $storeReference = null)
    {
        $draft = ImportOrder::of();

        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setCountry('DE')
            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 100))
            ->setLineItems(
                LineItemImportDraftCollection::of()
                    ->add(
                        LineItemImportDraft::ofNamePriceVariantAndQuantity(
                            LocalizedString::ofLangAndText('en', 'test'),
                            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)),
                            ProductVariantImportDraft::ofSku($variant->getSku()),
                            1
                        )
                    )
            );
        if (!is_null($storeReference)) {
            $draft->setStore($storeReference);
        }

        return $draft;
    }

    final public static function defaultOrderImportDraftBuilderFunction(ImportOrder $importOrder)
    {
        return $importOrder;
    }

    final public static function defaultOrderImportFunction(ApiClient $client, ImportOrder $importOrder)
    {
        $request = RequestBuilder::of()->orders()->import($importOrder);

        try {
            $response = $client->execute($request);
        } catch (ApiServiceException $e) {
            throw self::toFixtureException($e);
        }

        return $request->mapFromResponse($response);
    }

    final public static function defaultOrderDeleteFunction(ApiClient $client, Order $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withDraftOrderImport(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ProductFixture::withPublishedProduct(
            $client,
            function (
                Product $product,
                ProductType $productType,
                TaxCategory $taxCategory
            ) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                CustomerFixture::withDraftCustomer(
                    $client,
                    function (CustomerDraft $customerDraft) use ($taxCategory) {
                        $state = $taxCategory->getRates()->current()->getState();
                        $customerDraft
                            ->setAddresses(
                                AddressCollection::of()->add(
                                    Address::of()
                                        ->setCountry('DE')
                                        ->setState($state)
                                )
                            )
                            ->setDefaultBillingAddress(0)
                            ->setDefaultShippingAddress(0);

                        return $customerDraft;
                    },
                    function (Customer $customer) use (
                        $client,
                        $product,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($customer, $product) {
                                return call_user_func(
                                    [__CLASS__, 'orderImportDraftFunction'],
                                    $customer,
                                    $product
                                );
                            };
                        } else {
                            $draftFunction = function () use (
                                $customer,
                                $product,
                                $draftFunction
                            ) {
                                return call_user_func($draftFunction, $customer, $product);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultOrderImportFunction'];
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
                            [$customer, $product]
                        );
                    }
                );
            }
        );
    }

    final public static function withOrderImport(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftOrderImport(
            $client,
            [__CLASS__, 'defaultOrderImportDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withDraftStoreOrderImport(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ProductFixture::withPublishedProduct(
            $client,
            function (
                Product $product,
                ProductType $productType,
                TaxCategory $taxCategory
            ) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                StoreFixture::withStore(
                    $client,
                    function (Store $store) use (
                        $client,
                        $taxCategory,
                        $product,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction
                    ) {
                        CustomerFixture::withDraftCustomer(
                            $client,
                            function (CustomerDraft $customerDraft) use ($taxCategory) {
                                $state = $taxCategory->getRates()->current()->getState();
                                $customerDraft
                                    ->setAddresses(
                                        AddressCollection::of()->add(
                                            Address::of()
                                                ->setCountry('DE')
                                                ->setState($state)
                                        )
                                    )
                                    ->setDefaultBillingAddress(0)
                                    ->setDefaultShippingAddress(0);

                                return $customerDraft;
                            },
                            function (Customer $customer) use (
                                $client,
                                $product,
                                $store,
                                $draftBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $draftFunction
                            ) {
                                $storeReference = StoreReference::ofId($store->getId());
                                if ($draftFunction == null) {
                                    $draftFunction = function () use ($customer, $product, $storeReference) {
                                        return call_user_func(
                                            [__CLASS__, 'orderImportDraftFunction'],
                                            $customer,
                                            $product,
                                            $storeReference
                                        );
                                    };
                                } else {
                                    $draftFunction = function () use (
                                        $customer,
                                        $product,
                                        $storeReference,
                                        $draftFunction
                                    ) {
                                        return call_user_func($draftFunction, $customer, $product, $storeReference);
                                    };
                                }
                                if ($createFunction == null) {
                                    $createFunction = [__CLASS__, 'defaultOrderImportFunction'];
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
                                    [$customer, $product, $store]
                                );
                            }
                        );
                    }
                );
            }
        );
    }

    final public static function withStoreOrderImport(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftStoreOrderImport(
            $client,
            [__CLASS__, 'defaultOrderImportDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withDraftOrderImportWithInventory(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ProductFixture::withPublishedProduct(
            $client,
            function (
                Product $product,
                ProductType $productType,
                TaxCategory $taxCategory
            ) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                InventoryFixture::withDraftInventory(
                    $client,
                    function (InventoryDraft $inventoryDraft) use ($product) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                        return $inventoryDraft->setSku($variant->getSku())->setQuantityOnStock(1);
                    },
                    function (InventoryEntry $inventory) use (
                        $client,
                        $draftBuilderFunction,
                        $assertFunction,
                        $createFunction,
                        $deleteFunction,
                        $draftFunction,
                        $taxCategory,
                        $product
                    ) {
                        CustomerFixture::withDraftCustomer(
                            $client,
                            function (CustomerDraft $customerDraft) use ($taxCategory) {
                                $state = $taxCategory->getRates()->current()->getState();
                                $customerDraft
                                    ->setAddresses(
                                        AddressCollection::of()->add(
                                            Address::of()
                                                ->setCountry('DE')
                                                ->setState($state)
                                        )
                                    )
                                    ->setDefaultBillingAddress(0)
                                    ->setDefaultShippingAddress(0);

                                return $customerDraft;
                            },
                            function (Customer $customer) use (
                                $client,
                                $product,
                                $draftBuilderFunction,
                                $assertFunction,
                                $createFunction,
                                $deleteFunction,
                                $draftFunction,
                                $inventory
                            ) {
                                if ($draftFunction == null) {
                                    $draftFunction = function () use ($customer, $product) {
                                        return call_user_func(
                                            [__CLASS__, 'orderImportDraftFunction'],
                                            $customer,
                                            $product
                                        );
                                    };
                                } else {
                                    $draftFunction = function () use (
                                        $customer,
                                        $product,
                                        $draftFunction
                                    ) {
                                        return call_user_func($draftFunction, $customer, $product);
                                    };
                                }
                                if ($createFunction == null) {
                                    $createFunction = [__CLASS__, 'defaultOrderImportFunction'];
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
                                    [$customer, $product, $inventory]
                                );
                            }
                        );
                    }
                );
            }
        );
    }
}
