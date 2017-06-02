<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#productvariant
 * @method ProductVariant current()
 * @method ProductVariantCollection add(ProductVariant $element)
 * @method ProductVariant getAt($offset)
 */
class ProductVariantCollection extends Collection
{
    const ID = 'id';
    const SKU = 'sku';
    const MATCHING = 'isMatchingVariant';
    protected $type = ProductVariant::class;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductVariant) {
            $id = $row->getId();
            $sku = $row->getSku();
            $matching = $row->getIsMatchingVariant();
        } else {
            $id = isset($row[static::ID])? $row[static::ID] : null;
            $sku = isset($row[static::SKU])? $row[static::SKU] : null;
            $matching = isset($row[static::MATCHING])? $row[static::MATCHING] : false;
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::SKU, $offset, $sku);
        $this->addToIndex(static::MATCHING, $offset, $matching);
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

    public function getMatchingVariant()
    {
        return $this->getBy(static::MATCHING, true);
    }
}
