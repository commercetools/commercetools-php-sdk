<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method Message current()
 * @method Message getAt($offset)
 */
class MessageCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Message\Message';
}
