<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#deliveryremoved-message
 * @method string getId()
 * @method DeliveryRemovedMessage setId(string $id = null)
 * @method int getVersion()
 * @method DeliveryRemovedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DeliveryRemovedMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DeliveryRemovedMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method DeliveryRemovedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method DeliveryRemovedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method DeliveryRemovedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method DeliveryRemovedMessage setType(string $type = null)
 * @method Delivery getDelivery()
 * @method DeliveryRemovedMessage setDelivery(Delivery $delivery = null)
 */
class DeliveryRemovedMessage extends Message
{
    const MESSAGE_TYPE = 'DeliveryRemoved';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['delivery'] = [static::TYPE => Delivery::class];

        return $definitions;
    }
}
