<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Messages;

use Commercetools\Core\Client\JsonEndpoint;

/**
 * @package Commercetools\Core\Request\Messages
 */
class MessagesEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('messages');
    }
}
