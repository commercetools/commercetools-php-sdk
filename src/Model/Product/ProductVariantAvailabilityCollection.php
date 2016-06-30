<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#productvariantavailability
 * @method ProductVariantAvailabilityCollection add(ProductVariantAvailability $element)
 * @method ProductVariantAvailability current()
 * @method ProductVariantAvailability getAt($offset)
 */
class ProductVariantAvailabilityCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\ProductVariantAvailability';
}
