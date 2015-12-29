<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method DateTimeDecorator getTimestamp()
 * @method Transaction setTimestamp(\DateTime $timestamp = null)
 * @method string getType()
 * @method Transaction setType(string $type = null)
 * @method Money getAmount()
 * @method Transaction setAmount(Money $amount = null)
 * @method string getInteractionId()
 * @method Transaction setInteractionId(string $interactionId = null)
 */
class Transaction extends JsonObject
{
    const AUTHORIZATION = 'Authorization';
    const CANCEL_AUTHORIZATION = 'CancelAuthorization';
    const CHARGE = 'Charge';
    const REFUND = 'Refund';
    const CHARGE_BACK = 'Chargeback';

    public function fieldDefinitions()
    {
        return [
            'timestamp' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'type' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'interactionId' => [static::TYPE => 'string'],
        ];
    }
}
