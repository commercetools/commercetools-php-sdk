<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

/**
 * Class TransactionType
 * @deprecated use Transaction::<TYPE> instead
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#transactiontype
 */
class TransactionType
{
    const AUTHORIZATION = 'AUTHORIZATION';
    const CANCEL_AUTHORIZATION = 'CANCEL_AUTHORIZATION';
    const CHARGE = 'CHARGE';
    const REFUND = 'REFUND';
    const CHARGEBACK = 'CHARGEBACK';
}
