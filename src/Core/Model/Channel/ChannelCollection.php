<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Channel
 * @link https://docs.commercetools.com/http-api-projects-channels.html#channel
 * @method Channel current()
 * @method ChannelCollection add(Channel $element)
 * @method Channel getAt($offset)
 * @method Channel getById($offset)
 */
class ChannelCollection extends Collection
{
    protected $type = Channel::class;
}
