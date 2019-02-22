<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Payment\Transaction;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#paymenttransactionstatechanged-message
 * @method string getId()
 * @method PaymentTransactionStateChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentTransactionStateChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentTransactionStateChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentTransactionStateChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentTransactionStateChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentTransactionStateChangedMessage setType(string $type = null)
 * @method string getState()
 * @method PaymentTransactionStateChangedMessage setState(string $state = null)
 * @method int getVersion()
 * @method PaymentTransactionStateChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentTransactionStateChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getTransactionId()
 * @method PaymentTransactionStateChangedMessage setTransactionId(string $transactionId = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method PaymentTransactionStateChangedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class PaymentTransactionStateChangedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentTransactionStateChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['transactionId'] = [static::TYPE => 'string'];
        $definitions['state'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
