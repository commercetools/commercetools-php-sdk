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
use Commercetools\Core\Model\Order\TrackingData;
use DateTime;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parceltrackingdataupdated-message
 */
class ParcelTrackingDataUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelTrackingDataUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcelId'] = [static::TYPE => 'string'];
        $definitions['trackingData'] = [static::TYPE => TrackingData::class];

        return $definitions;
    }
}
