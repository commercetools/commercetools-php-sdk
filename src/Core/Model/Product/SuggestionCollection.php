<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products-search.html#representations
 * @method Suggestion current()
 * @method SuggestionCollection add(Suggestion $element)
 * @method Suggestion getAt($offset)
 */
class SuggestionCollection extends Collection
{
    protected $type = Suggestion::class;
}
