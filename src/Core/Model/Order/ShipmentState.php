<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#shipmentstate
 */
class ShipmentState
{
    const SHIPPED = 'Shipped';
    const READY = 'Ready';
    const PENDING = 'Pending';
    const PARTIAL = 'Partial';
    const BACKORDER = 'Backorder';
    const DELAYED = 'Delayed';
}
