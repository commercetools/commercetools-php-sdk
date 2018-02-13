<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#zonerate
 * @method ZoneRate current()
 * @method ZoneRateCollection add(ZoneRate $element)
 * @method ZoneRate getAt($offset)
 */
class ZoneRateCollection extends Collection
{
    protected $type = ZoneRate::class;
}
