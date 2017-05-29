<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\ShoppingLists
 */
class ShoppingListsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('shopping-lists');
    }
}
