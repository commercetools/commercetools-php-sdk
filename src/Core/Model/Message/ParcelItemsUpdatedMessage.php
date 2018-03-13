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
 * @link https://docs.commercetools.com/http-api-projects-messages.html#parceltrackingdataupdated-message
 */
class ParcelItemsUpdatedMessage extends Message
{
    const MESSAGE_TYPE = 'ParcelItemsUpdated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['deliveryId'] = [static::TYPE => 'string'];
        $definitions['parcelId'] = [static::TYPE => 'string'];
        $definitions['items'] = [static::TYPE => DeliveryItemCollection::class];

        return $definitions;
    }
}
