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
