<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Collection;

/**
 * Class ProductTypeCollection
 * @package Sphere\Core\Model\ProductType
 * 
 * @method ProductType current()
 * @method ProductType getAt($offset)
 */
class ProductTypeCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\ProductType\ProductType';
}
