<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraftCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#paymentdraft
 * @method CustomerReference getCustomer()
 * @method PaymentDraft setCustomer(CustomerReference $customer = null)
 * @method string getInterfaceId()
 * @method PaymentDraft setInterfaceId(string $interfaceId = null)
 * @method Money getAmountPlanned()
 * @method PaymentDraft setAmountPlanned(Money $amountPlanned = null)
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

    /**
     * @deprecated
     * @return string
     */
    public function getExternalId()
    {
        return parent::getExternalId();
    }

    /**
     * @deprecated
     * @param string $externalId
     * @return static
     */
    public function setExternalId($externalId = null)
    {
        return parent::setExternalId($externalId);
    }

    /**
     * @deprecated
     * @return Money
     */
    public function getAmountAuthorized()
    {
        return parent::getAmountAuthorized();
    }

    /**
     * @deprecated
     * @param Money $amountAuthorized
     * @return static
     */
    public function setAmountAuthorized(Money $amountAuthorized = null)
    {
        return parent::setAmountAuthorized($amountAuthorized);
    }

    /**
     * @deprecated
     * @return Money
     */
    public function getAmountPaid()
    {
        return parent::getAmountPaid();
    }

    /**
     * @deprecated
     * @param Money $amountPaid
     * @return static
     */
    public function setAmountPaid(Money $amountPaid = null)
    {
        return parent::setAmountPaid($amountPaid);
    }

    /**
     * @deprecated
     * @return Money
     */
    public function getAmountRefunded()
    {
        return parent::getAmountRefunded();
    }

    /**
     * @deprecated
     * @param Money $amountRefunded
     * @return static
     */
    public function setAmountRefunded(Money $amountRefunded = null)
    {
        return parent::setAmountRefunded($amountRefunded);
    }

    /**
     * @deprecated
     * @return Money
     */
    public function getAuthorizedUntil()
    {
        return parent::getAuthorizedUntil();
    }

    /**
     * @deprecated
     * @param Money $amountUntil
     * @return static
     */
    public function setAuthorizedUntil(Money $amountUntil = null)
    {
        return parent::setAuthorizedUntil($amountUntil);
    }
}
