<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

/**
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#inventory-mode
 */
class InventoryMode
{
    const TRACK_ONLY = 'TrackOnly';
    const RESERVE_ON_ORDER = 'ReserveOnOrder';
    const NONE = 'None';
}
