<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#deliveryaddressset-message
 * @method string getId()
 * @method DeliveryAddressSetMessage setId(string $id = null)
 * @method int getVersion()
 * @method DeliveryAddressSetMessage setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method DeliveryAddressSetMessage setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method DeliveryAddressSetMessage setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method int getSequenceNumber()
 * @method DeliveryAddressSetMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method DeliveryAddressSetMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method DeliveryAddressSetMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method DeliveryAddressSetMessage setType(string $type = null)
 * @method string getDeliveryId()
 * @method DeliveryAddressSetMessage setDeliveryId(string $deliveryId = null)
 * @method Address getAddress()
 * @method DeliveryAddressSetMessage setAddress(Address $address = null)
 */
class DeliveryAddressSetMessage extends Message
{
    const MESSAGE_TYPE = 'DeliveryAddressSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['address'] = [static::TYPE => Address::class];

        return $definitions;
    }
}
