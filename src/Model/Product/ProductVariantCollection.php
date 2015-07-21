<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Product
 * @method ProductVariant current()
 * @method ProductVariant getAt($offset)
 */
class ProductVariantCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\ProductVariant';
}
