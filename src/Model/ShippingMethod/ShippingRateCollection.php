<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @method ShippingRate current()
 * @method ShippingRateCollection add(ShippingRate $element)
 * @method ShippingRate getAt($offset)
 */
class ShippingRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\ShippingMethod\ShippingRate';
}
