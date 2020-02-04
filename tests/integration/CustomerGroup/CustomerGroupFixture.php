<?php

namespace Commercetools\Core\IntegrationTests\CustomerGroup;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;

class CustomerGroupFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CustomerGroupCreateRequest::class;
    const DELETE_REQUEST_TYPE = CustomerGroupDeleteRequest::class;

    final public static function uniqueCustomerGroupString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCustomerGroupDraftFunction()
    {
        $uniqueCustomerGroupString = self::uniqueCustomerGroupString();
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $uniqueCustomerGroupString . '-group'
        );

        return $draft;
    }

    final public static function defaultCustomerGroupDraftBuilderFunction(CustomerGroupDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCustomerGroupCreateFunction(ApiClient $client, CustomerGroupDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultCustomerGroupDeleteFunction(ApiClient $client, CustomerGroup $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCustomerGroup(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCustomerGroupDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCustomerGroupCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCustomerGroupDeleteFunction'];
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

    final public static function withDraftCustomerGroup(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCustomerGroupDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCustomerGroupCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCustomerGroupDeleteFunction'];
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

    final public static function withCustomerGroup(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCustomerGroup(
            $client,
            [__CLASS__, 'defaultCustomerGroupDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCustomerGroup(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCustomerGroup(
            $client,
            [__CLASS__, 'defaultCustomerGroupDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
