<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Common\Collection;

/**
 * Class ChannelCollection
 * @package Sphere\Core\Model\Channel
 * 
 * @method Channel current()
 * @method Channel getAt($offset)
 */
class ChannelCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Channel\Channel';
}
