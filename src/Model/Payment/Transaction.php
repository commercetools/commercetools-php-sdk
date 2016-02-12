<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#transaction
 * @method DateTimeDecorator getTimestamp()
 * @method Transaction setTimestamp(\DateTime $timestamp = null)
 * @method string getType()
 * @method Transaction setType(string $type = null)
 * @method Money getAmount()
 * @method Transaction setAmount(Money $amount = null)
 * @method string getInteractionId()
 * @method Transaction setInteractionId(string $interactionId = null)
 * @method string getId()
 * @method Transaction setId(string $id = null)
 * @method StateReference getState()
 * @method Transaction setState(StateReference $state = null)
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
            'id' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
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
