<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Collection;

/**
 * Class FacetResultCollection
 * @package Sphere\Core\Model\Product
 * @method FacetResult current()
 * @method FacetResult getAt($offset)
 */
class FacetResultCollection extends Collection
{
    const OFFSET = 'offset';

    protected $type = '\Sphere\Core\Model\Product\FacetResult';

    /**
     * @param $name
     * @return FacetResult
     */
    public function getByName($name)
    {
        return $this->getAt($name);
    }
}
