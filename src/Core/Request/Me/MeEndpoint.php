<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Client\JsonEndpoint;

class MeEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('me');
    }
}
