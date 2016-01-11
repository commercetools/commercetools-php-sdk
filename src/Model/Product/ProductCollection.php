<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method Product current()
 * @method ProductCollection add(Product $element)
 * @method Product getAt($offset)
 */
class ProductCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\Product';
}
