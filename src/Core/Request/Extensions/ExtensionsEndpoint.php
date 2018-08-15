<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Client\JsonEndpoint;

class ExtensionsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('extensions');
    }
}
