<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method FacetTerm current()
 * @method FacetTermCollection add(FacetTerm $element)
 * @method FacetTerm getAt($offset)
 */
class FacetTermCollection extends Collection
{
    protected $type = FacetTerm::class;
}
