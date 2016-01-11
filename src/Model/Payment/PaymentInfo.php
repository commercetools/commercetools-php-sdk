<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method PaymentReferenceCollection getPayments()
 * @method PaymentInfo setPayments(PaymentReferenceCollection $payments = null)
 */
class PaymentInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'payments' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentReferenceCollection'],
        ];
    }
}
