<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Subscription
 * @link https://dev.commercetools.com/http-api-projects-subscriptions.html#subscription
 * @method Subscription current()
 * @method SubscriptionCollection add(Subscription $element)
 * @method Subscription getAt($offset)
 * @method Subscription getById($offset)
 */
class SubscriptionCollection extends Collection
{
    protected $type = Subscription::class;
}
