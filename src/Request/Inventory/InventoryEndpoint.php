<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Inventory
 */
class InventoryEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('inventory');
    }
}
