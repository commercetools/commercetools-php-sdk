<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#shipment-state
 */
class ShipmentState
{
    const SHIPPED = 'Shipped';
    const READY = 'Ready';
    const PENDING = 'Pending';
    const PARTIAL = 'Partial';
    const BACKORDER = 'Backorder';
}
