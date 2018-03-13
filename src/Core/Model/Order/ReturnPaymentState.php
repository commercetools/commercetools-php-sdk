<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://docs.commercetools.com/http-api-projects-orders.html#returnpaymentstate
 */
class ReturnPaymentState
{
    const NON_REFUNDABLE = 'NonRefundable';
    const INITIAL = 'Initial';
    const REFUNDED = 'Refunded';
    const NOT_REFUNDED = 'NotRefunded';
}
