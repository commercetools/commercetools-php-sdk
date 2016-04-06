<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product\Search
 *
 * @method FilterRange current()
 * @method FilterRangeCollection add(FilterRange $element)
 * @method FilterRange getAt($offset)
 */
class FilterRangeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\Search\FilterRange';

    public function __toString()
    {
        $values = [];
        foreach ($this as $value) {
            $values[] = (string)$value;
        }
        return sprintf('range%s', implode(',', $values));
    }
}
