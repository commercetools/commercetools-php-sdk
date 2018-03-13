<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingratedraft
 * @method ShippingRateDraft current()
 * @method ShippingRateDraftCollection add(ShippingRateDraft $element)
 * @method ShippingRateDraft getAt($offset)
 */
class ShippingRateDraftCollection extends Collection
{
    protected $type = ShippingRateDraft::class;
}
