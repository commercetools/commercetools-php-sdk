<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Message
 * @deprecated Use PaymentTransactionStateChangedMessage instead
 * @method string getId()
 * @method PaymentTransactionChangedMessage setId(string $id = null)
 * @method int getVersion()
 * @method PaymentTransactionChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentTransactionChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentTransactionChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method PaymentTransactionChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentTransactionChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentTransactionChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentTransactionChangedMessage setType(string $type = null)
 * @method string getTransactionId()
 * @method PaymentTransactionChangedMessage setTransactionId(string $transactionId = null)
 * @method string getState()
 * @method PaymentTransactionChangedMessage setState(string $state = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method PaymentTransactionChangedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class PaymentTransactionChangedMessage extends PaymentTransactionStateChangedMessage
{

}
