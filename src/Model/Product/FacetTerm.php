<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @method string getTerm()
 * @method FacetTerm setTerm(string $term = null)
 * @method int getCount()
 * @method FacetTerm setCount(int $count = null)
 */
class FacetTerm extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'term' => [static::TYPE => 'string'],
            'count' => [static::TYPE => 'int']
        ];
    }
}
