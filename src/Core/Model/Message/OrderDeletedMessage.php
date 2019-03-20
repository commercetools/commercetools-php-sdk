<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-message-types.html#orderdeleted-message
 * @method string getId()
 * @method OrderDeletedMessage setId(string $id = null)
 * @method int getVersion()
 * @method OrderDeletedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderDeletedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderDeletedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method OrderDeletedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderDeletedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderDeletedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderDeletedMessage setType(string $type = null)
 * @method Order getOrder()
 * @method OrderDeletedMessage setOrder(Order $order = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method OrderDeletedMessage setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class OrderDeletedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderDeleted';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['order'] = [static::TYPE => Order::class];

        return $definitions;
    }
}
