<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @deprecated use \Commercetools\Core\Model\Product\Search\FilterRangeCollection instead. Will be removed in v1.0.0
 * @method FilterRange current()
 * @method FilterRangeCollection add(FilterRange $element)
 * @method FilterRange getAt($offset)
 */
class FilterRangeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\FilterRange';

    public function __toString()
    {
        $values = [];
        foreach ($this as $value) {
            $values[] = (string)$value;
        }
        return sprintf('range%s', implode(',', $values));
    }
}
