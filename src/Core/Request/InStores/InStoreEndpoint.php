<?php
/**
 */

namespace Commercetools\Core\Request\InStores;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\InStores
 */
class InStoreEndpoint
{
    /**
     * @param string $storeKey
     * @return JsonEndpoint
     */
    public static function endpoint($storeKey)
    {
        return new JsonEndpoint('in-store/key=' . $storeKey . '/');
    }
}
