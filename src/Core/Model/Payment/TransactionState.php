<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

/**
 * Class TransactionState
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#transactionstate
 */
class TransactionState
{
    const INITIAL = "Initial";
    const PENDING = 'Pending';
    const SUCCESS = 'Success';
    const FAILURE = 'Failure';
}
