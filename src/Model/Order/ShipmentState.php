<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class ShipmentState
 * @package Sphere\Core\Model\Order
 */
class ShipmentState
{
    const SHIPPED = 'Shipped';
    const READY = 'Ready';
    const PENDING = 'Pending';
    const PARTIAL = 'Partial';
    const BACKORDER = 'Backorder';
}
