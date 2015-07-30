<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#order-state
 */
class OrderState
{
    const OPEN = 'Open';
    const COMPLETE = 'Complete';
    const CANCELLED = 'Cancelled';
}
