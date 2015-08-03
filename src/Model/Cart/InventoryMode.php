<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Cart;

/**
 * @package Commercetools\Core\Model\Cart
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#inventory-mode
 */
class InventoryMode
{
    const TRACK_ONLY = 'TrackOnly';
    const RESERVE_ON_ORDER = 'ReserveOnOrder';
    const NONE = 'None';
}
