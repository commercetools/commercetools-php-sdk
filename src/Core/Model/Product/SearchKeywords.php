<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#searchkeywords
 * @method SearchKeyword current()
 * @method SearchKeywords add(SearchKeyword $element)
 * @method SearchKeyword getAt($offset)
 */
class SearchKeywords extends Collection
{
    protected $type = SearchKeyword::class;

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
