<?php

namespace Commercetools\Core\IntegrationTests\Project;

use Commercetools\Core\Client\ApiClient;
use Commercetools\Core\Helper\Uuid;
use Commercetools\Core\IntegrationTests\ResourceFixture;

class ProjectFixture extends ResourceFixture
{
    final public static function uniqueProjectString()
    {
        return 'test-' . Uuid::uuidv4();
    }

    final public static function withProject(
        ApiClient $client,
        callable $assertFunction
    ) {
        self::withoutResource($assertFunction, $client);
    }
}
