<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class PaymentState
 * @package Sphere\Core\Model\Order
 */
class PaymentState
{
    const BALANCE_DUE = 'BalanceDue';
    const FAILED = 'Failed';
    const PENDING = 'Pending';
    const CREDIT_OWED = 'CreditOwed';
    const PAID = 'Paid';
}
