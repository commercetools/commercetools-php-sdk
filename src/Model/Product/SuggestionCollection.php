<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Model\Common\Collection;

/**
 * Class SuggestionCollection
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products-search.html#suggest-representations-result
 */
class SuggestionCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\Suggestion';
}
