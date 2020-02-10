<?php

namespace Commercetools\Core\IntegrationTests\Project;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;

class ProjectFixture extends ResourceFixture
{
    final public static function emptyFunction()
    {
        return null;
    }

    final public static function projectGetFunction(ApiClient $client)
    {
        $request = RequestBuilder::of()->project()->get();
        $response = $client->execute($request);

        return $request->mapFromResponse($response);
    }

    final public static function uniqueProjectString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function withProject(
        ApiClient $client,
        callable $assertFunction
    ) {
        self::withDraftResource(
            $client,
            [__CLASS__, 'emptyFunction'],
            $assertFunction,
            [__CLASS__, 'projectGetFunction'],
            [__CLASS__, 'emptyFunction'],
            [__CLASS__, 'emptyFunction']
        );
    }
}
