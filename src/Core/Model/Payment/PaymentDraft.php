<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectCollection;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraftCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#paymentdraft
 * @method CustomerReference getCustomer()
 * @method PaymentDraft setCustomer(CustomerReference $customer = null)
 * @method string getExternalId()
 * @method PaymentDraft setExternalId(string $externalId = null)
 * @method string getInterfaceId()
 * @method PaymentDraft setInterfaceId(string $interfaceId = null)
 * @method Money getAmountPlanned()
 * @method PaymentDraft setAmountPlanned(Money $amountPlanned = null)
 * @method Money getAmountAuthorized()
 * @method PaymentDraft setAmountAuthorized(Money $amountAuthorized = null)
 * @method DateTimeDecorator getAuthorizedUntil()
 * @method PaymentDraft setAuthorizedUntil(DateTime $authorizedUntil = null)
 * @method Money getAmountPaid()
 * @method PaymentDraft setAmountPaid(Money $amountPaid = null)
 * @method Money getAmountRefunded()
 * @method PaymentDraft setAmountRefunded(Money $amountRefunded = null)
 * @method PaymentMethodInfo getPaymentMethodInfo()
 * @method PaymentDraft setPaymentMethodInfo(PaymentMethodInfo $paymentMethodInfo = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method PaymentDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method PaymentStatus getPaymentStatus()
 * @method PaymentDraft setPaymentStatus(PaymentStatus $paymentStatus = null)
 * @method TransactionCollection getTransactions()
 * @method PaymentDraft setTransactions(TransactionCollection $transactions = null)
 * @method CustomFieldObjectDraftCollection getInterfaceInteractions()
 * @method PaymentDraft setInterfaceInteractions(CustomFieldObjectDraftCollection $interfaceInteractions = null)
 * @method string getKey()
 * @method PaymentDraft setKey(string $key = null)
 */
class PaymentDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'customer' => [static::TYPE => CustomerReference::class],
            'externalId' => [static::TYPE => 'string'],
            'interfaceId' => [static::TYPE => 'string'],
            'amountPlanned' => [static::TYPE => Money::class],
            'amountAuthorized' => [static::TYPE => Money::class],
            'authorizedUntil' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'amountPaid' => [static::TYPE => Money::class],
            'amountRefunded' => [static::TYPE => Money::class],
            'paymentMethodInfo' => [static::TYPE => PaymentMethodInfo::class],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'paymentStatus' => [static::TYPE => PaymentStatus::class],
            'transactions' => [static::TYPE => TransactionCollection::class],
            'interfaceInteractions' => [
                static::TYPE => CustomFieldObjectDraftCollection::class
            ],
        ];
    }
}
