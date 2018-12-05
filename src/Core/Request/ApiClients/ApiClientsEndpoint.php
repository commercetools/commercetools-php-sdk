<?php
/**
 */

namespace Commercetools\Core\Request\ApiClients;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\ApiClients
 */
class ApiClientsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('api-clients');
    }
}
