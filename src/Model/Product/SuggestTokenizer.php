<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#search-keyword-tokenizer
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
