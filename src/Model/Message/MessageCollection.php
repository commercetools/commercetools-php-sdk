<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Message;

use Sphere\Core\Model\Common\Collection;

/**
 * Class MessageCollection
 * @package Sphere\Core\Model\Message
 * 
 * @method Message current()
 * @method Message getAt($offset)
 */
class MessageCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Message\Message';
}
