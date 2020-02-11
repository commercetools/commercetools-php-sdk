<?php

namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ApiServiceException;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CustomerFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CustomerCreateRequest::class;
    const DELETE_REQUEST_TYPE = CustomerDeleteRequest::class;
    const EXTERNAL_USER_HEADER = 'X-External-User-ID';

    final public static function uniqueCustomerString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function customerDraftFunction($storeReference)
    {
        $uniqueCustomerString = self::uniqueCustomerString();
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'TEST-' . $uniqueCustomerString . '-em.ail+sphere@example.org',
            'test-' . $uniqueCustomerString . '-name',
            'test-' . $uniqueCustomerString . '-lastName',
            'test-' . $uniqueCustomerString . '-password'
        );
        if (!empty($storeReference)) {
            $draft->setStores(StoreReferenceCollection::of()->add($storeReference));
        }

        return $draft;
    }

    final public static function defaultCustomerDraftBuilderFunction(CustomerDraft $draft)
    {
        return $draft;
    }

    public static function customerCreateFunction(
        ApiClient $client,
        CustomerDraft $draft
    ) {
        $headers[self::EXTERNAL_USER_HEADER] = ['custom-external-user-id'];

        $request = CustomerCreateRequest::ofDraft($draft);

        try {
            $response = $client->execute($request, $headers);
        } catch (ApiServiceException $e) {
            throw self::toFixtureException($e);
        }

        $result = $request->mapFromResponse($response);

        return $result->getCustomer();
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
                        return call_user_func(
                            [__CLASS__, 'customerDraftFunction'],
                            $storeReference
                        );
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
                    $createFunction = [__CLASS__, 'customerCreateFunction'];
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
                    $draftFunction,
                    [$store]
                );
            }
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
                        return call_user_func(
                            [__CLASS__, 'customerDraftFunction'],
                            $storeReference
                        );
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
                    $createFunction = [__CLASS__, 'customerCreateFunction'];
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
                    [$store]
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
