<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method PaymentCollection getPayments()
 * @method PaymentInfo setPayments(PaymentCollection $payments = null)
 */
class PaymentInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'payments' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentCollection'],
        ];
    }
}
