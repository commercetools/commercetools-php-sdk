<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Messages;


use Sphere\Core\Client\JsonEndpoint;

/**
 * @package Sphere\Core\Request\Messages
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
