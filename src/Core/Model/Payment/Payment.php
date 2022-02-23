<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://docs.commercetools.com/http-api-projects-payments.html#payment
 * @method string getId()
 * @method Payment setId(string $id = null)
 * @method int getVersion()
 * @method Payment setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Payment setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Payment setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method CustomerReference getCustomer()
 * @method Payment setCustomer(CustomerReference $customer = null)
 * @method string getInterfaceId()
 * @method Payment setInterfaceId(string $interfaceId = null)
 * @method Money getAmountPlanned()
 * @method Payment setAmountPlanned(Money $amountPlanned = null)
 * @method PaymentMethodInfo getPaymentMethodInfo()
 * @method Payment setPaymentMethodInfo(PaymentMethodInfo $paymentMethodInfo = null)
 * @method CustomFieldObject getCustom()
 * @method Payment setCustom(CustomFieldObject $custom = null)
 * @method PaymentStatus getPaymentStatus()
 * @method Payment setPaymentStatus(PaymentStatus $paymentStatus = null)
 * @method TransactionCollection getTransactions()
 * @method Payment setTransactions(TransactionCollection $transactions = null)
 * @method CustomFieldObjectCollection getInterfaceInteractions()
 * @method Payment setInterfaceInteractions(CustomFieldObjectCollection $interfaceInteractions = null)
 * @method string getKey()
 * @method Payment setKey(string $key = null)
 * @method string getAnonymousId()
 * @method Payment setAnonymousId(string $anonymousId = null)
 * @method CreatedBy getCreatedBy()
 * @method Payment setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Payment setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method PaymentReference getReference()
 */
class Payment extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
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
            'paymentMethodInfo' => [static::TYPE => PaymentMethodInfo::class],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'paymentStatus' => [static::TYPE => PaymentStatus::class],
            'transactions' => [static::TYPE => TransactionCollection::class],
            'interfaceInteractions' => [
                static::TYPE => CustomFieldObjectCollection::class
            ],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
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
