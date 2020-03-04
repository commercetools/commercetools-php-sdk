<?php

namespace Commercetools\Core\IntegrationTests\Cart;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\ShippingMethod\ShippingMethodFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;

class CartFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CartCreateRequest::class;
    const DELETE_REQUEST_TYPE = CartDeleteRequest::class;
    const RAND_MAX = 10000;

    final public static function uniqueCartString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCartDraftFunction()
    {
        $draft = CartDraft::ofCurrency('EUR')->setCountry('DE');

        return $draft;
    }

    final public static function customerCartDraftFunction(Customer $customer, ShippingMethod $shippingMethod)
    {
        $draft = CartDraft::ofCurrency('EUR')->setCountry('DE');

        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setShippingMethod($shippingMethod->getReference());

        return $draft;
    }

    final public static function defaultCartDraftBuilderFunction(CartDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCartCreateFunction(ApiClient $client, CartDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultCartDeleteFunction(ApiClient $client, Cart $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCart(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCartDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCartCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCartDeleteFunction'];
        }

        parent::withUpdateableDraftResource(
            $client,
            $draftBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withDraftCart(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCartDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCartCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCartDeleteFunction'];
        }

        parent::withDraftResource(
            $client,
            $draftBuilderFunction,
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
    final public static function withDraftCustomerCart(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        ShippingMethodFixture::withShippingMethod(
            $client,
            function (
                ShippingMethod $shippingMethod,
                Zone $zone
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
                    function (CustomerDraft $customerDraft) use ($zone) {
                        $region = $zone->getLocations()->current()->getState();

                        $customerDraft
                            ->setAddresses(
                                AddressCollection::of()->add(
                                    Address::of()
                                        ->setCountry('DE')
                                        ->setState($region)
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
                        $draftFunction
                    ) {
                        if ($draftFunction == null) {
                            $draftFunction = function () use ($customer, $shippingMethod) {
                                return call_user_func(
                                    [__CLASS__, 'customerCartDraftFunction'],
                                    $customer,
                                    $shippingMethod
                                );
                            };
                        } else {
                            $draftFunction = function () use (
                                $customer,
                                $shippingMethod,
                                $draftFunction
                            ) {
                                return call_user_func($draftFunction, $customer, $shippingMethod);
                            };
                        }
                        if ($createFunction == null) {
                            $createFunction = [__CLASS__, 'defaultCartCreateFunction'];
                        }
                        if ($deleteFunction == null) {
                            $deleteFunction = [__CLASS__, 'defaultCartDeleteFunction'];
                        }

                        parent::withDraftResource(
                            $client,
                            $draftBuilderFunction,
                            $assertFunction,
                            $createFunction,
                            $deleteFunction,
                            $draftFunction,
                            [$customer, $shippingMethod]
                        );
                    }
                );
            }
        );
    }

    final public static function withCustomerCart(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCustomerCart(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withCart(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCart(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCart(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCart(
            $client,
            [__CLASS__, 'defaultCartDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
