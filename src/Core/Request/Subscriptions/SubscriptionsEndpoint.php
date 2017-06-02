<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Subscriptions;

use Commercetools\Core\Client\JsonEndpoint;

class SubscriptionsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('subscriptions');
    }
}
