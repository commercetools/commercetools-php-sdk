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
        return sprintf('range%s', implode(',', $this->toArray()));
    }
}
