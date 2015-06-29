<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Model\Common\Collection;

class FilterRangeCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\FilterRange';

    public function __toString()
    {
        $values = [];
        foreach ($this as $value) {
            $values[] = (string)$value;
        }
        return sprintf('range%s', implode(',', $values));
    }
}
