<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#new-product-variant
 * @method ProductVariantDraftCollection add(ProductVariantDraft $element)
 * @method ProductVariantDraft current()
 * @method ProductVariantDraft getAt($offset)
 */
class ProductVariantDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\ProductVariantDraft';
}
