<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\State\StateReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#transaction
 * @method DateTimeDecorator getTimestamp()
 * @method Transaction setTimestamp(DateTime $timestamp = null)
 * @method string getType()
 * @method Transaction setType(string $type = null)
 * @method Money getAmount()
 * @method Transaction setAmount(Money $amount = null)
 * @method string getInteractionId()
 * @method Transaction setInteractionId(string $interactionId = null)
 * @method string getId()
 * @method Transaction setId(string $id = null)
 * @method string getState()
 * @method Transaction setState(string $state = null)
 * @method CustomFieldObject getCustom()
 * @method Transaction setCustom(CustomFieldObject $custom = null)
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
            'state' => [static::TYPE => 'string'],
            'timestamp' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'type' => [static::TYPE => 'string'],
            'amount' => [static::TYPE => Money::class],
            'interactionId' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => CustomFieldObject::class],
        ];
    }
}
