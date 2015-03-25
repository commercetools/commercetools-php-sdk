<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;


use Sphere\Core\Client\JsonEndpoint;

/**
 * Class ChannelsEndpoint
 * @package Sphere\Core\Request\Channels
 */
class ChannelsEndpoint
{
    /**
     * @return JsonEndpoint
     */
    public static function endpoint()
    {
        return new JsonEndpoint('channels');
    }
}
