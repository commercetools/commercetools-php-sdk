<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://docs.commercetools.com/http-api-projects-zones.html#location
 * @method Location current()
 * @method LocationCollection add(Location $element)
 * @method Location getAt($offset)
 */
class LocationCollection extends Collection
{
    protected $type = Location::class;
}
