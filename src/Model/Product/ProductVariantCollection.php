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
    const ID = 'id';
    protected $type = '\Commercetools\Core\Model\Product\ProductVariant';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductVariant) {
            $id = $row->getId();
        } else {
            $id = $row[static::ID];
        }
        $this->addToIndex(static::ID, $offset, $id);
    }

    /**
     * @param $id
     * @return ProductVariant
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }
}
