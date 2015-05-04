<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class ShipmentState
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#shipment-state
 */
class ShipmentState
{
    const SHIPPED = 'Shipped';
    const READY = 'Ready';
    const PENDING = 'Pending';
    const PARTIAL = 'Partial';
    const BACKORDER = 'Backorder';
}
