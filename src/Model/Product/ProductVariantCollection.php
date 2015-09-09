<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method ProductVariant current()
 * @method ProductVariantCollection add(ProductVariant $element)
 * @method ProductVariant getAt($offset)
 */
class ProductVariantCollection extends Collection
{
    const ID = 'id';
    const SKU = 'sku';
    protected $type = '\Commercetools\Core\Model\Product\ProductVariant';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductVariant) {
            $id = $row->getId();
            $sku = $row->getSku();
        } else {
            $id = $row[static::ID];
            $sku = $row[static::SKU];
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::SKU, $offset, $sku);
    }

    /**
     * @param $id
     * @return ProductVariant
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }

    /**
     * @param $id
     * @return ProductVariant
     */
    public function getBySku($id)
    {
        return $this->getBy(static::SKU, $id);
    }
}
