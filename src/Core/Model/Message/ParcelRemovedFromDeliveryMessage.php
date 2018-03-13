<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\Parcel;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parcelremovedfromdelivery-message
 */
class ParcelRemovedFromDeliveryMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelRemovedFromDelivery';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcel'] = [static::TYPE => Parcel::class];

        return $definitions;
    }
}
