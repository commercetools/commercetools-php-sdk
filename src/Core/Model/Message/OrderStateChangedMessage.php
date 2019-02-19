<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderstatechanged-message
 * @method string getId()
 * @method OrderStateChangedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderStateChangedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderStateChangedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderStateChangedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderStateChangedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderStateChangedMessage setType(string $type = null)
 * @method string getOrderState()
 * @method OrderStateChangedMessage setOrderState(string $orderState = null)
 * @method int getVersion()
 * @method OrderStateChangedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderStateChangedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderStateChangedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderStateChangedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderStateChanged';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['orderState'] = [static::TYPE => 'string'];

        return $definitions;
    }
}
