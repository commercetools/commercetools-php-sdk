<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Channel;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Channel
 * @link https://dev.commercetools.com/http-api-projects-channels.html#channel
 * @method Channel current()
 * @method ChannelCollection add(Channel $element)
 * @method Channel getAt($offset)
 */
class ChannelCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Channel\Channel';
}
