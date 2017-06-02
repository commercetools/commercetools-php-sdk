<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectCollection;
use DateTime;

/**
 * @package Commercetools\Core\Model\Payment
 * @link https://dev.commercetools.com/http-api-projects-payments.html#payment
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
 * @method string getExternalId()
 * @method Payment setExternalId(string $externalId = null)
 * @method string getInterfaceId()
 * @method Payment setInterfaceId(string $interfaceId = null)
 * @method Money getAmountPlanned()
 * @method Payment setAmountPlanned(Money $amountPlanned = null)
 * @method Money getAmountAuthorized()
 * @method Payment setAmountAuthorized(Money $amountAuthorized = null)
 * @method DateTimeDecorator getAuthorizedUntil()
 * @method Payment setAuthorizedUntil(DateTime $authorizedUntil = null)
 * @method Money getAmountPaid()
 * @method Payment setAmountPaid(Money $amountPaid = null)
 * @method Money getAmountRefunded()
 * @method Payment setAmountRefunded(Money $amountRefunded = null)
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
 * @method PaymentReference getReference()
 */
class Payment extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
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
            'custom' => [static::TYPE => CustomFieldObject::class],
            'paymentStatus' => [static::TYPE => PaymentStatus::class],
            'transactions' => [static::TYPE => TransactionCollection::class],
            'interfaceInteractions' => [
                static::TYPE => CustomFieldObjectCollection::class
            ],
        ];
    }
}
