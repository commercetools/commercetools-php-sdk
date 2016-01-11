<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method FacetRange current()
 * @method FacetRangeCollection add(FacetRange $element)
 * @method FacetRange getAt($offset)
 */
class FacetRangeCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\FacetRange';
}
