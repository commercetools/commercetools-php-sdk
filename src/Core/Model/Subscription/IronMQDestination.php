<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getType()
 * @method IronMQDestination setType(string $type = null)
 * @method string getUri()
 * @method IronMQDestination setUri(string $uri = null)
 */
class IronMQDestination extends Destination
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'uri' => [static::TYPE => 'string']
        ];
    }

    public static function ofUri($uri, Context $context = null)
    {
        return static::of($context)->setType(static::DESTINATION_IRON_MQ)->setUri($uri);
    }
}
