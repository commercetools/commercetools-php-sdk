<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#search-keywords
 * @method SearchKeyword current()
 * @method SearchKeywords add(SearchKeyword $element)
 * @method SearchKeyword getAt($offset)
 */
class SearchKeywords extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\SearchKeyword';

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
