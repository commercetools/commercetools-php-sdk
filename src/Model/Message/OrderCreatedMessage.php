<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Order;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#ordercreated-message
 * @method string getId()
 * @method OrderCreatedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method OrderCreatedMessage setCreatedAt(DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method OrderCreatedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method OrderCreatedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method OrderCreatedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method OrderCreatedMessage setType(string $type = null)
 * @method Order getOrder()
 * @method OrderCreatedMessage setOrder(Order $order = null)
 * @method int getVersion()
 * @method OrderCreatedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method OrderCreatedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 */
class OrderCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'OrderCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['order'] = [static::TYPE => Order::class];

        return $definitions;
    }
}
