<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\Parcel;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#parcel-added-to-delivery-message
 * @method string getId()
 * @method ParcelAddedToDeliveryMessage setId(string $id = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ParcelAddedToDeliveryMessage setCreatedAt(\DateTime $createdAt = null)
 * @method int getSequenceNumber()
 * @method ParcelAddedToDeliveryMessage setSequenceNumber(int $sequenceNumber = null)
 * @method Reference getResource()
 * @method ParcelAddedToDeliveryMessage setResource(Reference $resource = null)
 * @method int getResourceVersion()
 * @method ParcelAddedToDeliveryMessage setResourceVersion(int $resourceVersion = null)
 * @method string getType()
 * @method ParcelAddedToDeliveryMessage setType(string $type = null)
 * @method Delivery getDelivery()
 * @method ParcelAddedToDeliveryMessage setDelivery(Delivery $delivery = null)
 * @method Parcel getParcel()
 * @method ParcelAddedToDeliveryMessage setParcel(Parcel $parcel = null)
 */
class ParcelAddedToDeliveryMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelAddedToDelivery';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['delivery'] = [static::TYPE => '\Commercetools\Core\Model\Order\Delivery'];
        $definitions['parcel'] = [static::TYPE => '\Commercetools\Core\Model\Order\Parcel'];

        return $definitions;
    }
}
