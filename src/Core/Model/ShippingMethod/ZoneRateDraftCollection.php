<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#zoneratedraft
 * @method ZoneRateDraft current()
 * @method ZoneRateDraftCollection add(ZoneRateDraft $element)
 * @method ZoneRateDraft getAt($offset)
 */
class ZoneRateDraftCollection extends Collection
{
    protected $type = ZoneRateDraft::class;
}
