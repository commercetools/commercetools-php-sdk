<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#orderpaymentstatechanged-message
 * @method string getId()
 * @method OrderPaymentChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderPaymentChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderPaymentChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderPaymentChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderPaymentChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderPaymentChangedMessage setType(string $type = null)
 * @method int getVersion()
 * @method OrderPaymentChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderPaymentChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getPaymentState()
 * @method OrderPaymentChangedMessage setPaymentState(string $paymentState = null)
 */
class OrderPaymentChangedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderPaymentStateChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['paymentState'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
