<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

/**
 * @package Commercetools\Core\Model\Product\Search
 */
class Facet extends Filter
{
    const COUNTING_PRODUCTS = 'counting products';
    private $countingProducts = false;

    public function countingProducts($counting = true)
    {
        $this->countingProducts = $counting;

        return $this;
    }

    public function isCountingProducts()
    {
        return $this->countingProducts;
    }

    public function __toString()
    {
        $str = parent::__toString();
        if ($this->isCountingProducts()) {
            $str .= ' ' . static::COUNTING_PRODUCTS;
        }
        return $str;
    }
}
