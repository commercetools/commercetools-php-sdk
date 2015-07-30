<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#return-payment-state
 */
class ReturnPaymentState
{
    const NON_REFUNDABLE = 'NonRefundable';
    const INITIAL = 'Initial';
    const REFUNDED = 'Refunded';
    const NOT_REFUNDED = 'NotRefunded';
}
