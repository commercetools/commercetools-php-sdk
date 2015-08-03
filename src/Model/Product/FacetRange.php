<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @method int getFrom()
 * @method FacetRange setFrom(int $from = null)
 * @method string getFromStr()
 * @method FacetRange setFromStr(string $fromStr = null)
 * @method int getTo()
 * @method FacetRange setTo(int $to = null)
 * @method string getToStr()
 * @method FacetRange setToStr(string $toStr = null)
 * @method int getCount()
 * @method FacetRange setCount(int $count = null)
 * @method int getTotalCount()
 * @method FacetRange setTotalCount(int $totalCount = null)
 * @method int getTotal()
 * @method FacetRange setTotal(int $total = null)
 * @method int getMin()
 * @method FacetRange setMin(int $min = null)
 * @method int getMax()
 * @method FacetRange setMax(int $max = null)
 * @method int getMean()
 * @method FacetRange setMean(int $mean = null)
 */
class FacetRange extends JsonObject
{
    public function getFields()
    {
        return [
            "from" => [static::TYPE => 'int'],
            "fromStr" => [static::TYPE => 'string'],
            "to" => [static::TYPE => 'int'],
            "toStr" => [static::TYPE => 'string'],
            "count" => [static::TYPE => 'int'],
            "totalCount" => [static::TYPE => 'int'],
            "total" => [static::TYPE => 'int'],
            "min" => [static::TYPE => 'int'],
            "max" => [static::TYPE => 'int'],
            "mean" => [static::TYPE => 'int'],
        ];
    }
}
