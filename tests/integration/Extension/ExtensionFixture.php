<?php

namespace Commercetools\Core\IntegrationTests\Extension;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Model\Extension\ExtensionDraft;
use Commercetools\Core\Model\Extension\HttpDestination;
use Commercetools\Core\Model\Extension\Trigger;
use Commercetools\Core\Model\Extension\TriggerCollection;
use Commercetools\Core\Request\Extensions\ExtensionCreateRequest;
use Commercetools\Core\Request\Extensions\ExtensionDeleteRequest;

class ExtensionFixture extends ResourceFixture
{
    const CREATE_REQUEST_TYPE = ExtensionCreateRequest::class;
    const DELETE_REQUEST_TYPE = ExtensionDeleteRequest::class;

    final public static function uniqueExtensionString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function defaultExtensionDraftFunction()
    {
        $uniqueExtensionString = self::uniqueExtensionString();
        $draft = ExtensionDraft::ofDestinationAndTriggers(
            HttpDestination::of()->setUrl('https://api.europe-west1.gcp.commercetools.com'),
            TriggerCollection::of()->add(
                Trigger::of()->setResourceTypeId('cart')->setActions([Trigger::ACTION_CREATE])
            )
        )->setKey('test-' . $uniqueExtensionString);

        return $draft;
    }

    final public static function defaultExtensionDraftBuilderFunction(ExtensionDraft $draft)
    {
        return $draft;
    }

    final public static function defaultExtensionCreateFunction(ApiClient $client, ExtensionDraft $draft)
    {
        return parent::defaultCreateFunction($client, self::CREATE_REQUEST_TYPE, $draft);
    }

    final public static function defaultExtensionDeleteFunction(ApiClient $client, Extension $resource)
    {
        return parent::defaultDeleteFunction($client, self::DELETE_REQUEST_TYPE, $resource);
    }

    final public static function withUpdateableDraftExtension(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultExtensionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultExtensionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultExtensionDeleteFunction'];
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

    final public static function withDraftExtension(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        if ($draftFunction == null) {
            $draftFunction = [__CLASS__, 'defaultExtensionDraftFunction'];
        }
        if ($createFunction == null) {
            $createFunction = [__CLASS__, 'defaultExtensionCreateFunction'];
        }
        if ($deleteFunction == null) {
            $deleteFunction = [__CLASS__, 'defaultExtensionDeleteFunction'];
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

    final public static function withExtension(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withDraftExtension(
            $client,
            [__CLASS__, 'defaultExtensionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }

    final public static function withUpdateableExtension(
        ApiClient $client,
        callable $assertFunction,
        callable $createFunction = null,
        callable $deleteFunction = null,
        callable $draftFunction = null
    ) {
        self::withUpdateableDraftExtension(
            $client,
            [__CLASS__, 'defaultExtensionDraftBuilderFunction'],
            $assertFunction,
            $createFunction,
            $deleteFunction,
            $draftFunction
        );
    }
}
