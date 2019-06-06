<?php
/**
 */

namespace Commercetools\Core\Request\Stores;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Stores
 */
class StoresEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('stores');
    }
}
