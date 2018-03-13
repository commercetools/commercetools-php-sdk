<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method MessageSubscriptionCollection add(MessageSubscription $element)
 * @method MessageSubscription current()
 * @method MessageSubscription getAt($offset)
 */
class MessageSubscriptionCollection extends Collection
{
    protected $type = MessageSubscription::class;
}
