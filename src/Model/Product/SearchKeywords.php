<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#search-keywords
 * @method SearchKeyword current()
 * @method SearchKeyword getAt($offset)
 */
class SearchKeywords extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\SearchKeyword';

    /**
     * @return string
     */
    public function __toString()
    {
        $text = [];
        foreach ($this as $keyword) {
            $text[] = (string)$keyword;
        }
        return implode(', ', $text);
    }
}
