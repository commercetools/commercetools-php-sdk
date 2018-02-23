<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://docs.commercetools.com/http-api-projects-zones.html#zone
 * @method Zone current()
 * @method ZoneCollection add(Zone $element)
 * @method Zone getAt($offset)
 * @method Zone getById($offset)
 */
class ZoneCollection extends Collection
{
    protected $type = Zone::class;
}
