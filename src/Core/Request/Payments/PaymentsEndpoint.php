<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Client\JsonEndpoint;

class PaymentsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('payments');
    }
}
