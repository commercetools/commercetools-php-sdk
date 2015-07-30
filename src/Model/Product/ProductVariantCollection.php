<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method ProductVariant current()
 * @method ProductVariant getAt($offset)
 */
class ProductVariantCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\ProductVariant';
}
