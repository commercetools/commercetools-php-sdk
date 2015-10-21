<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\CustomField\CustomFieldObjectCollection;

/**
 * @package Commercetools\Core\Model\Payment
 * @method string getId()
 * @method Payment setId(string $id = null)
 * @method int getVersion()
 * @method Payment setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Payment setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Payment setLastModifiedAt(\DateTime $lastModifiedAt = null)
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
 * @method Payment setAuthorizedUntil(\DateTime $authorizedUntil = null)
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
 */
class Payment extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'customer' => [static::TYPE => '\Commercetools\Core\Model\Customer\CustomerReference'],
            'externalId' => [static::TYPE => 'string'],
            'interfaceId' => [static::TYPE => 'string'],
            'amountPlanned' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'amountAuthorized' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'authorizedUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'amountPaid' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'amountRefunded' => [static::TYPE => '\Commercetools\Core\Model\Common\Money'],
            'paymentMethodInfo' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentMethodInfo'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
            'paymentStatus' => [static::TYPE => '\Commercetools\Core\Model\Payment\PaymentStatus'],
            'transactions' => [static::TYPE => '\Commercetools\Core\Model\Payment\TransactionCollection'],
            'interfaceInteractions' => [
                static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObjectCollection'
            ],
        ];
    }
}
