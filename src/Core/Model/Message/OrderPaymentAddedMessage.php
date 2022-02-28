<?php

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Payment\PaymentReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderpaymentstatechanged-message
 * @method string getId()
 * @method OrderPaymentAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderPaymentAddedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderPaymentAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderPaymentAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderPaymentAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderPaymentAddedMessage setType(string $type = null)
 * @method int getVersion()
 * @method OrderPaymentAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderPaymentAddedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method PaymentReference getPaymentState()
 * @method OrderPaymentAddedMessage setPayment(PaymentReference $payment = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderPaymentAddedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method PaymentReference getPayment()
 */
class OrderPaymentAddedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderPaymentAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['payment'] = [static::TYPE => PaymentReference::class];

        return $definitions;
    }
}
