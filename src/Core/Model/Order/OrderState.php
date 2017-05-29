<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#orderstate
 */
class OrderState
{
    const OPEN = 'Open';
    const CONFIRMED = 'Confirmed';
    const COMPLETE = 'Complete';
    const CANCELLED = 'Cancelled';
}
