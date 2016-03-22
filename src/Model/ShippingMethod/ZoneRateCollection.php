<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#zone-rate
 * @method ZoneRate current()
 * @method ZoneRateCollection add(ZoneRate $element)
 * @method ZoneRate getAt($offset)
 */
class ZoneRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\ShippingMethod\ZoneRate';
}
