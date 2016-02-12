<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

/**
 * @package Commercetools\Core\Model\Channel
 * @link http://dev.commercetools.com/http-api-projects-channels.html#channel-role-enum
 */
class ChannelRole
{
    const INVENTORY_SUPPLY = 'InventorySupply';
    const ORDER_EXPORT = 'OrderExport';
    const ORDER_IMPORT = 'OrderImport';
    const PRIMARY = 'Primary';
    const PRODUCT_DISTRIBUTION = 'ProductDistribution';
}
