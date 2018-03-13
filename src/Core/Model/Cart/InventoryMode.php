<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

/**
 * @package Commercetools\Core\Model\Cart
 * @link https://docs.commercetools.com/http-api-projects-carts.html#inventorymode
 */
class InventoryMode
{
    const TRACK_ONLY = 'TrackOnly';
    const RESERVE_ON_ORDER = 'ReserveOnOrder';
    const NONE = 'None';
}
