<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @ramlTestIgnoreFields('inputs')
 * @link https://docs.commercetools.com/http-api-projects-products.html#product-search-keywords-suggest-examples
 * @method string getType()
 * @method SuggestTokenizer setType(string $type = null)
 * @method array getInputs()
 * @method SuggestTokenizer setInputs(array $inputs = null)
 */
class SuggestTokenizer extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'inputs' => [static::TYPE => 'array'],
        ];
    }
}
