<?php

namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;

class CustomerFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CustomerCreateRequest::class;
    const DELETE_REQUEST_TYPE = CustomerDeleteRequest::class;

    final public static function uniqueCustomerString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCustomerDraftFunction()
    {
        $uniqueCustomerString = self::uniqueCustomerString();
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'TEST-' . $uniqueCustomerString . '-em.ail+sphere@example.org',
            'test-' . $uniqueCustomerString . '-name',
            'test-' . $uniqueCustomerString . '-lastName',
            'test-' . $uniqueCustomerString . '-password'
        );

        return $draft;
    }

    final public static function defaultCustomerDraftBuilderFunction(CustomerDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCustomerCreateFunction(ApiClient $client, CustomerDraft $draft)
    {
        $createFunctionCustomerSignIn = parent::defaultCreateFunction(
            $client,
            self::CREATE_REQUEST_TYPE,
            $draft
        );

        $customer = new Customer($createFunctionCustomerSignIn->getCustomer()->toArray());

        return $customer;
    }

    final public static function defaultCustomerDeleteFunction(ApiClient $client, Customer $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCustomer(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCustomerDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCustomerCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCustomerDeleteFunction'];
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

    final public static function withDraftCustomer(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        StoreFixture::withStore(
            $client,
            function (Store $store) use (
                $client,
                $draftBuilderFunction,
                $assertFunction,
                $createFunction,
                $deleteFunction,
                $draftFunction
            ) {
                $storeReference = StoreReference::ofId($store->getId());

                if ($draftFunction == null) {
                    $draftFunction = function () use ($storeReference) {
                        return call_user_func([__CLASS__, 'defaultCustomerDraftFunction'], $storeReference);
                    };
                } else {
                    $draftFunction = function () use (
                        $storeReference,
                        $draftFunction
                    ) {
                        return call_user_func($draftFunction, $storeReference);
                    };
                }
                if ($createFunction == null) {
                    $createFunction = [__CLASS__, 'defaultCustomerCreateFunction'];
                }
                if ($deleteFunction == null) {
                    $deleteFunction = [__CLASS__, 'defaultCustomerDeleteFunction'];
                }

                parent::withDraftResource(
                    $client,
                    $draftBuilderFunction,
                    $assertFunction,
                    $createFunction,
                    $deleteFunction,
                    $draftFunction,
                    [$storeReference]
                );
            }
        );
    }

    final public static function withCustomer(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCustomer(
            $client,
            [__CLASS__, 'defaultCustomerDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCustomer(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCustomer(
            $client,
            [__CLASS__, 'defaultCustomerDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
