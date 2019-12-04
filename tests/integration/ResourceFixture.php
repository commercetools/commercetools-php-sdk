<?php
namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Model\Common\Resource;

abstract class ResourceFixture
{
    private static $testRun;

    public static function getTestRun()
    {
        if (is_null(self::$testRun)) {
            self::$testRun = md5(microtime());
        }

        return self::$testRun;
    }

    final protected static function defaultCreateFunction(ApiClient $client, $createRequestType, $draft)
    {
        $request = $createRequestType::ofDraft($draft);

        $response = $client->execute($request);

        return $request->mapFromResponse($response);
    }

    final protected static function defaultDeleteFunction(ApiClient $client, $deleteRequestType, Resource $resource)
    {
        $request = $deleteRequestType::ofIdAndVersion($resource->getId(), $resource->getVersion());

        $response = $client->execute($request);

        return $request->mapFromResponse($response);
    }

    final protected static function withUpdatableDraftResource(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction,
        callable $deleteFunction,
        callable $draftFunction
    ) {
        $resourceDraft = call_user_func($draftFunction);

        $resourceDraft = call_user_func($draftBuilderFunction, $resourceDraft);

        $resource = call_user_func($createFunction, $client, $resourceDraft);

        try {
            $resource = call_user_func($assertFunction, $resource);
        } finally {
            call_user_func($deleteFunction, $client, $resource);
        }
    }

    final protected static function withDraftResource(
        ApiClient $client,
        callable $draftBuilderFunction,
        callable $assertFunction,
        callable $createFunction,
        callable $deleteFunction,
        callable $draftFunction
    ) {
        $initialDraft = call_user_func($draftFunction);

        $resourceDraft = call_user_func($draftBuilderFunction, $initialDraft);

        $resource = call_user_func($createFunction, $client, $resourceDraft);

        try {
            call_user_func($assertFunction, $resource);
        } finally {
            call_user_func($deleteFunction, $client, $resource);
        }
    }
}
