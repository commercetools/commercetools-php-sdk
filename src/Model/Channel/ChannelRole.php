<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Channel;


/**
 * Class ChannelRole
 * @package Sphere\Core\Model\Channel
 * @link http://dev.sphere.io/http-api-projects-channels.html#channel-role-enum
 */
class ChannelRole
{
    const INVENTORY_SUPPLY = 'InventorySupply';
    const ORDER_EXPORT = 'OrderExport';
    const ORDER_IMPORT = 'OrderImport';
    const PRIMARY = 'Primary';
}
