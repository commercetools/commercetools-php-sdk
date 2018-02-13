<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @method string getTerm()
 * @method FacetTerm setTerm(string $term = null)
 * @method int getCount()
 * @method FacetTerm setCount(int $count = null)
 * @method int getProductCount()
 * @method FacetTerm setProductCount(int $productCount = null)
 */
class FacetTerm extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'term' => [static::TYPE => 'string'],
            'count' => [static::TYPE => 'int'],
            'productCount' => [static::TYPE => 'int'],
        ];
    }
}
