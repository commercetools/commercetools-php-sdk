<?php
/**
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Me
 */
class MeShoppingListsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('me/shopping-lists');
    }
}
