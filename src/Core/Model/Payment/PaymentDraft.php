<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Context;
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
 * @method string getAnonymousId()
 * @method PaymentDraft setAnonymousId(string $anonymousId = null)
 */
class PaymentDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customer' => [static::TYPE => CustomerReference::class, static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'externalId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'interfaceId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'amountPlanned' => [static::TYPE => Money::class],
            'amountAuthorized' => [static::TYPE => Money::class, static::OPTIONAL => true],
            'authorizedUntil' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'amountPaid' => [static::TYPE => Money::class, static::OPTIONAL => true],
            'amountRefunded' => [static::TYPE => Money::class, static::OPTIONAL => true],
            'paymentMethodInfo' => [static::TYPE => PaymentMethodInfo::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'paymentStatus' => [static::TYPE => PaymentStatus::class, static::OPTIONAL => true],
            'transactions' => [static::TYPE => TransactionCollection::class, static::OPTIONAL => true],
            'interfaceInteractions' => [
                static::TYPE => CustomFieldObjectDraftCollection::class,
                static::OPTIONAL => true
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
     * @deprecated use setKey() instead
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

    /**
     * @param Money $amountPlanned
     * @param Context|callable $context
     * @return PaymentDraft
     */
    public static function ofAmountPlanned(Money $amountPlanned, $context = null)
    {
        return static::of($context)->setAmountPlanned($amountPlanned);
    }

    /**
     * @param string $key
     * @param string $externalId
     * @param Money $amountPlanned
     * @param Context|callable $context
     * @return PaymentDraft
     */
    public static function ofKeyExternalIdAndAmountPlanned($key, $externalId, Money $amountPlanned, $context = null)
    {
        return static::of($context)->setKey($key)->setExternalId($externalId)->setAmountPlanned($amountPlanned);
    }

    /**
     * @param string $key
     * @param string $externalId
     * @param Money $amountPlanned
     * @param PaymentMethodInfo $paymentMethodInfo
     * @param Context|callable $context
     * @return PaymentDraft
     */
    public static function ofKeyExternalIdAmountPlannedAndPaymentMethodInfo(
        $key,
        $externalId,
        Money $amountPlanned,
        PaymentMethodInfo $paymentMethodInfo,
        $context = null
    ) {
        return static::of($context)
            ->setKey($key)
            ->setExternalId($externalId)
            ->setAmountPlanned($amountPlanned)
            ->setPaymentMethodInfo($paymentMethodInfo);
    }
}
