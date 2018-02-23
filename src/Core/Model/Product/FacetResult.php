<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @method string getType()
 * @method FacetResult setType(string $type = null)
 * @method int getMissing()
 * @method FacetResult setMissing(int $missing = null)
 * @method int getTotal()
 * @method FacetResult setTotal(int $total = null)
 * @method int getOther()
 * @method FacetResult setOther(int $other = null)
 * @method FacetTermCollection getTerms()
 * @method FacetResult setTerms(FacetTermCollection $terms = null)
 * @method FacetRangeCollection getRanges()
 * @method FacetResult setRanges(FacetRangeCollection $ranges = null)
 */
class FacetResult extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'missing' => [static::TYPE => 'int'],
            'total' => [static::TYPE => 'int'],
            'other' => [static::TYPE => 'int'],
            'terms' => [static::TYPE => FacetTermCollection::class],
            'ranges' => [static::TYPE => FacetRangeCollection::class]
        ];
    }
}
