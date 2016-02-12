<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products-search.html#suggest-representations-result
 * @method Suggestion current()
 * @method SuggestionCollection add(Suggestion $element)
 * @method Suggestion getAt($offset)
 */
class SuggestionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\Suggestion';
}
