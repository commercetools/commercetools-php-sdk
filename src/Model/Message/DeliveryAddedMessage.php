<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#deliveryadded-message
 * @method string getId()
 * @method DeliveryAddedMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DeliveryAddedMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method DeliveryAddedMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method DeliveryAddedMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method DeliveryAddedMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method DeliveryAddedMessage setType(string $type = null)
 * @method Delivery getDelivery()
 * @method DeliveryAddedMessage setDelivery(Delivery $delivery = null)
 * @method int getVersion()
 * @method DeliveryAddedMessage setVersion(int $version = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DeliveryAddedMessage setLastModifiedAt(\DateTime $lastModifiedAt = null)
 */
class DeliveryAddedMessage extends Message
{
    const MESSAGE_TYPE = 'DeliveryAdded';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['delivery'] = [static::TYPE => Delivery::class];

        return $definitions;
    }
}
