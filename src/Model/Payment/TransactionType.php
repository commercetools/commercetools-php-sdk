<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;


class TransactionType
{
    const AUTHORIZATION = 'AUTHORIZATION';
    const CANCEL_AUTHORIZATION = 'CANCEL_AUTHORIZATION';
    const CHARGE = 'CHARGE';
    const REFUND = 'REFUND';
    const CHARGEBACK = 'CHARGEBACK';
}
