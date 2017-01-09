<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Order
 * @link https://dev.commercetools.com/http-api-projects-orders.html#syncinfo
 * @method ChannelReference getChannel()
 * @method SyncInfo setChannel(ChannelReference $channel = null)
 * @method string getExternalId()
 * @method SyncInfo setExternalId(string $externalId = null)
 * @method DateTimeDecorator getSyncedAt()
 * @method SyncInfo setSyncedAt(\DateTime $syncedAt = null)
 */
class SyncInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'channel' => [static::TYPE => ChannelReference::class],
            'externalId' => [static::TYPE => 'string'],
            'syncedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
            ]
        ];
    }
}
