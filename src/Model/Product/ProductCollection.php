<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Product
 * @method Product current()
 * @method Product getAt($offset)
 */
class ProductCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\Product';
}
