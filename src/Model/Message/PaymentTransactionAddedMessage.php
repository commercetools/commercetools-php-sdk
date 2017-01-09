<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Payment\Transaction;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#paymenttransactionadded-message
 * @method string getId()
 * @method PaymentTransactionAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentTransactionAddedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentTransactionAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentTransactionAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentTransactionAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentTransactionAddedMessage setType(string $type = null)
 * @method Transaction getTransaction()
 * @method PaymentTransactionAddedMessage setTransaction(Transaction $transaction = null)
 * @method int getVersion()
 * @method PaymentTransactionAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentTransactionAddedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 */
class PaymentTransactionAddedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentTransactionAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['transaction'] = [static::TYPE => Transaction::class];

        return $definitions;
    }
}
