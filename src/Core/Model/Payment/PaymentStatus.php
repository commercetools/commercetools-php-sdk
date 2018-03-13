<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#paymentstatus
 * @method string getInterfaceCode()
 * @method PaymentStatus setInterfaceCode(string $interfaceCode = null)
 * @method string getInterfaceText()
 * @method PaymentStatus setInterfaceText(string $interfaceText = null)
 * @method StateReference getState()
 * @method PaymentStatus setState(StateReference $state = null)
 */
class PaymentStatus extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'interfaceCode' => [static::TYPE => 'string'],
            'interfaceText' => [static::TYPE => 'string'],
            'state' => [static::TYPE => StateReference::class],
        ];
    }
}
