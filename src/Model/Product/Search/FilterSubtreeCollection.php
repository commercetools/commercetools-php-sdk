<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product\Search;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Product\Search
 *
 * @method FilterSubtree current()
 * @method FilterSubtreeCollection add(FilterSubtree $element)
 * @method FilterSubtree getAt($offset)
 */
class FilterSubtreeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\Search\FilterSubtree';

    public function __toString()
    {
        $values = [];
        foreach ($this as $value) {
            $values[] = (string)$value;
        }
        return implode(',', $values);
    }

    /**
     * @param array $ids
     * @param Context|null $context
     * @return FilterSubtreeCollection
     */
    public static function ofIds(array $ids, Context $context = null)
    {
        $collection = static::of($context);

        foreach ($ids as $id) {
            $collection->add(FilterSubtree::ofId($id));
        }

        return $collection;
    }
}
