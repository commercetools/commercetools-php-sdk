<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#payment-state
 */
class PaymentState
{
    const BALANCE_DUE = 'BalanceDue';
    const FAILED = 'Failed';
    const PENDING = 'Pending';
    const CREDIT_OWED = 'CreditOwed';
    const PAID = 'Paid';
}
