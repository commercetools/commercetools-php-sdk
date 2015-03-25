<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class InventoryEndpoint
 * @package Sphere\Core\Request\Inventory
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
