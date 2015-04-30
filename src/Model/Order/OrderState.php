<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class OrderState
 * @package Sphere\Core\Model\Order
 * @link http://dev.sphere.io/http-api-projects-orders.html#order-state
 */
class OrderState
{
    const OPEN = 'Open';
    const COMPLETE = 'Complete';
    const CANCELLED = 'Cancelled';
}
