<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\Collection;

/**
 * Class ShippingRateCollection
 * @package Sphere\Core\Model\ShippingMethod
 * @method ShippingRate current()
 * @method ShippingRate getAt($offset)
 */
class ShippingRateCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\ShippingMethod\ShippingRate';
}
