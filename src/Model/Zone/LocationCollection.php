<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Zone
 * @method Location current()
 * @method Location getAt($offset)
 */
class LocationCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Zone\Location';
}
