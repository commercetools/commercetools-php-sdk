<?php
namespace Commercetools\Core\IntegrationTests;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Error\ApiServiceException;
use Commercetools\Core\Error\ConcurrentModificationError;
use Commercetools\Core\Error\ConcurrentModificationException;
use Commercetools\Core\Error\NotFoundException;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Response\ErrorResponse;

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

    final public static function toFixtureException(ApiServiceException $e)
    {
        $message = ($e->getResponse() != null) ? (string)$e->getResponse()->getBody() : $e->getMessage();
        $code = ($e->getResponse() != null) ? $e->getResponse()->getStatusCode() : $e->getCode();

        return new FixtureException($message, $code, $e);
    }

    final protected static function defaultCreateFunction(ApiClient $client, $createRequestType, $draft)
    {
        $request = $createRequestType::ofDraft($draft);

        try {
            $response = $client->execute($request);
        } catch (ApiServiceException $e) {
            throw self::toFixtureException($e);
        }

        return $request->mapFromResponse($response);
    }

    final protected static function defaultDeleteFunction(ApiClient $client, $deleteRequestType, Resource $resource)
    {
        $request = $deleteRequestType::ofIdAndVersion($resource->getId(), $resource->getVersion());

        try {
            $response = $client->execute($request);
        } catch (NotFoundException $e) {
            return null;
        } catch (ConcurrentModificationException $e) {
            $errorResponse = new ErrorResponse($e, $request, $e->getResponse());

            /** @var ConcurrentModificationError $error */
            $error = $errorResponse->getErrors()->getByCode(ConcurrentModificationError::CODE);
            $currentVersion = $error->getCurrentVersion();

            $request = $deleteRequestType::ofIdAndVersion($resource->getId(), $currentVersion);
            $response = $client->execute($request);
        } catch (ApiServiceException $e) {
            throw self::toFixtureException($e);
        }

        return $request->mapFromResponse($response);
    }

    final protected static function withUpdateableDraftResource(
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

        $updatedResource = null;
        try {
            $updatedResource = call_user_func($assertFunction, $resource);
        } finally {
            call_user_func($deleteFunction, $client, $updatedResource != null ? $updatedResource : $resource);
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

    final protected static function withoutResource(
        callable $assertFunction,
        ApiClient $client
    ) {
        call_user_func($assertFunction, $client);
    }
}
