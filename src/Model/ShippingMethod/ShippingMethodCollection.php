<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\Collection;

/**
 * Class ShippingMethodCollection
 * @package Sphere\Core\Model\ShippingMethod
 * 
 * @method ShippingMethod current()
 * @method ShippingMethod getAt($offset)
 */
class ShippingMethodCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\ShippingMethod\ShippingMethod';
}
