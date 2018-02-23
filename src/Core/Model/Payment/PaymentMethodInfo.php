<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#paymentmethodinfo
 * @method string getPaymentInterface()
 * @method PaymentMethodInfo setPaymentInterface(string $paymentInterface = null)
 * @method string getMethod()
 * @method PaymentMethodInfo setMethod(string $method = null)
 * @method LocalizedString getName()
 * @method PaymentMethodInfo setName(LocalizedString $name = null)
 */
class PaymentMethodInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'paymentInterface' => [static::TYPE => 'string'],
            'method' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }
}
