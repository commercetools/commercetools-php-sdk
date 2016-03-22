<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Zone;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Zone
 * @link https://dev.commercetools.com/http-api-projects-zones.html#zone
 * @method Zone current()
 * @method ZoneCollection add(Zone $element)
 * @method Zone getAt($offset)
 */
class ZoneCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Zone\Zone';
}
