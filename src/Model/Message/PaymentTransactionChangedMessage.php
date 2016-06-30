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
 * @link https://dev.commercetools.com/http-api-projects-messages.html#paymenttransactionstatechanged-message
 * @method string getId()
 * @method PaymentTransactionChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method PaymentTransactionChangedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method PaymentTransactionChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method PaymentTransactionChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method PaymentTransactionChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method PaymentTransactionChangedMessage setType(string $type = null)
 * @method string getState()
 * @method PaymentTransactionChangedMessage setState(string $state = null)
 * @method int getVersion()
 * @method PaymentTransactionChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method PaymentTransactionChangedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 */
class PaymentTransactionChangedMessage extends Message
{
    const MESSAGE_TYPE = 'PaymentTransactionChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['state'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
