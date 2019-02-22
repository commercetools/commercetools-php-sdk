<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#orderimported-message
 * @method string getId()
 * @method OrderImportedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderImportedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderImportedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderImportedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderImportedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderImportedMessage setType(string $type = null)
 * @method Order getOrder()
 * @method OrderImportedMessage setOrder(Order $order = null)
 * @method int getVersion()
 * @method OrderImportedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderImportedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderImportedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderImportedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderImported';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['order'] = [static::TYPE => Order::class];

        return $definitions;
    }
}
