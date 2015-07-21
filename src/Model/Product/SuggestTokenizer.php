<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products.html#search-keyword-tokenizer
 * @method string getType()
 * @method SuggestTokenizer setType(string $type = null)
 * @method array getInputs()
 * @method SuggestTokenizer setInputs(array $inputs = null)
 */
class SuggestTokenizer extends JsonObject
{
    public function getFields()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'inputs' => [static::TYPE => 'array'],
        ];
    }
}
