<?php

namespace Commercetools\Core\IntegrationTests\Store;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreDraft;
use Commercetools\Core\Request\Stores\StoreCreateRequest;
use Commercetools\Core\Request\Stores\StoreDeleteRequest;

class StoreFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = StoreCreateRequest::class;
    const DELETE_REQUEST_TYPE = StoreDeleteRequest::class;

    final public static function uniqueStoreString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultStoreDraftFunction()
    {
        $uniqueStoreString = self::uniqueStoreString();
        $draft = StoreDraft::ofKeyAndName(
            'key-' . $uniqueStoreString,
            LocalizedString::ofLangAndText('en', 'test-' . $uniqueStoreString . '-' . 'store-name')
        );
        return $draft;
    }

    final public static function defaultStoreDraftBuilderFunction(StoreDraft $draft)
    {
        return $draft;
    }

    final public static function defaultStoreCreateFunction(ApiClient $client, StoreDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultStoreDeleteFunction(ApiClient $client, Store $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftStore(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultStoreDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultStoreCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultStoreDeleteFunction'];
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

    final public static function withDraftStore(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultStoreDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultStoreCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultStoreDeleteFunction'];
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

    final public static function withStore(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftStore(
            $client,
            [__CLASS__, 'defaultStoreDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableStore(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftStore(
            $client,
            [__CLASS__, 'defaultStoreDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
