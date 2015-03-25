<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class ReturnPaymentState
 * @package Sphere\Core\Model\Order
 */
class ReturnPaymentState
{
    const NON_REFUNDABLE = 'NonRefundable';
    const INITIAL = 'Initial';
    const REFUNDED = 'Refunded';
    const NOT_REFUNDED = 'NotRefunded';
}
