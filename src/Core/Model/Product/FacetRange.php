<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
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
 * @method int getTotal()
 * @method FacetRange setTotal(int $total = null)
 * @method int getMin()
 * @method FacetRange setMin(int $min = null)
 * @method int getMax()
 * @method FacetRange setMax(int $max = null)
 * @method int getMean()
 * @method FacetRange setMean(int $mean = null)
 * @method int getProductCount()
 * @method FacetRange setProductCount(int $productCount = null)
 */
class FacetRange extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            "from" => [static::TYPE => 'int'],
            "fromStr" => [static::TYPE => 'string'],
            "to" => [static::TYPE => 'int'],
            "toStr" => [static::TYPE => 'string'],
            "count" => [static::TYPE => 'int'],
            "total" => [static::TYPE => 'int'],
            "min" => [static::TYPE => 'int'],
            "max" => [static::TYPE => 'int'],
            "mean" => [static::TYPE => 'int'],
            'productCount' => [static::TYPE => 'int', static::OPTIONAL => true],
        ];
    }

    /**
     * @deprecated use getCount instead - will be removed with version 3.0
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getCount();
    }

    /**
     * @deprecated use setCount instead - will be removed with version 3.0
     * @param int $totalCount
     * @return FacetRange
     */
    public function setTotalCount($totalCount = null)
    {
        return $this->setCount($totalCount);
    }
}
