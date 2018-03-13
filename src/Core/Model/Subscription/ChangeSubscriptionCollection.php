<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method ChangeSubscriptionCollection add(ChangeSubscription $element)
 * @method ChangeSubscription current()
 * @method ChangeSubscription getAt($offset)
 */
class ChangeSubscriptionCollection extends Collection
{
    protected $type = ChangeSubscription::class;
}
