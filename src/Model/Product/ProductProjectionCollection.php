<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Model\Common\Collection;

/**
 * Class ProductProjectionCollection
 * @package Sphere\Core\Model\Product
 * @method ProductProjection getAt($offset)
 * @method ProductProjection getById(string $id)
 */
class ProductProjectionCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\ProductProjection';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductProjection) {
            $id = $row->getId();
        } else {
            $id = $row['id'];
        }
        $this->addToIndex('id', $offset, $id);
    }
}
