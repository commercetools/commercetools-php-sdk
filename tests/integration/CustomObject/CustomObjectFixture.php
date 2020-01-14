<?php

namespace Commercetools\Core\IntegrationTests\CustomObject;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;

class CustomObjectFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = CustomObjectCreateRequest::class;
    const DELETE_REQUEST_TYPE = CustomObjectDeleteRequest::class;

    final public static function uniqueCustomObjectString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultCustomObjectDraftFunction()
    {
        $uniqueCustomObjectString = self::uniqueCustomObjectString();
        $draft = CustomObjectDraft::ofContainerKeyAndValue(
            'test-' . $uniqueCustomObjectString . '-container',
            'test-' . $uniqueCustomObjectString . '-key',
            'test-' . $uniqueCustomObjectString . '-value'
        );

        return $draft;
    }

    final public static function defaultCustomObjectDraftBuilderFunction(CustomObjectDraft $draft)
    {
        return $draft;
    }

    final public static function defaultCustomObjectCreateFunction(ApiClient $client, CustomObjectDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultCustomObjectDeleteFunction(ApiClient $client, CustomObject $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftCustomObject(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCustomObjectDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCustomObjectCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCustomObjectDeleteFunction'];
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

    final public static function withDraftCustomObject(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultCustomObjectDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultCustomObjectCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultCustomObjectDeleteFunction'];
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

    final public static function withCustomObject(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftCustomObject(
            $client,
            [__CLASS__, 'defaultCustomObjectDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableCustomObject(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftCustomObject(
            $client,
            [__CLASS__, 'defaultCustomObjectDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
