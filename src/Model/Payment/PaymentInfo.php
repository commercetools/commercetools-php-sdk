<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-orders.html#paymentinfo
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
