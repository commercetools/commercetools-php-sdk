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
 */
class ProductProjectionCollection extends Collection
{
    const ID = 'id';
    protected $type = '\Sphere\Core\Model\Product\ProductProjection';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductProjection) {
            $id = $row->getId();
        } else {
            $id = $row[static::ID];
        }
        $this->addToIndex(static::ID, $offset, $id);
    }

    /**
     * @param $id
     * @return ProductProjection
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }
}
