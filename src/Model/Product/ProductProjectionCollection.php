<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method ProductProjection current()
 * @method ProductProjectionCollection add(ProductProjection $element)
 * @method ProductProjection getAt($offset)
 */
class ProductProjectionCollection extends Collection
{
    const ID = 'id';
    protected $type = '\Commercetools\Core\Model\Product\ProductProjection';

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
