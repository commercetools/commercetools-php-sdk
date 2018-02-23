<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Channel
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-channels.html#channel
 * @method string getTypeId()
 * @method ChannelReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method ChannelReference setId(string $id = null)
 * @method Channel getObj()
 * @method ChannelReference setObj(Channel $obj = null)
 * @method string getKey()
 * @method ChannelReference setKey(string $key = null)
 */
class ChannelReference extends Reference
{
    const TYPE_CHANNEL = 'channel';
    const TYPE_CLASS = Channel::class;

    /**
     * @param $id
     * @param Context|callable $context
     * @return ChannelReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_CHANNEL, $id, $context);
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return ChannelReference
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofTypeAndKey(static::TYPE_CHANNEL, $key, $context);
    }
}
