<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Message
 * @link https://dev.commercetools.com/http-api-projects-messages.html#message
 * @method Message current()
 * @method MessageCollection add(Message $element)
 * @method Message getAt($offset)
 * @method Message getById($offset)
 */
class MessageCollection extends Collection
{
    protected $type = Message::class;
}
