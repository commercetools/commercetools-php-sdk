<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Product
 * @method string getTerm()
 * @method FacetTerm setTerm(string $term = null)
 * @method int getCount()
 * @method FacetTerm setCount(int $count = null)
 */
class FacetTerm extends JsonObject
{
    public function getFields()
    {
        return [
            'term' => [static::TYPE => 'string'],
            'count' => [static::TYPE => 'int']
        ];
    }
}
