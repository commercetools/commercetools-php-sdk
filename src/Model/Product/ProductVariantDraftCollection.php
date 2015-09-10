<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method ProductVariantDraftCollection add(ProductVariantDraft $element)
 * @method ProductVariantDraft current()
 * @method ProductVariantDraft getAt($offset)
 */
class ProductVariantDraftCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\ProductVariantDraft';
}
