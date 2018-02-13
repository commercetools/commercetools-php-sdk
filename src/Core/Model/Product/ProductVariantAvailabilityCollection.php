<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#productvariantavailability
 * @method ProductVariantAvailabilityCollection add(ProductVariantAvailability $element)
 * @method ProductVariantAvailability current()
 * @method ProductVariantAvailability getAt($offset)
 */
class ProductVariantAvailabilityCollection extends Collection
{
    protected $type = ProductVariantAvailability::class;
}
