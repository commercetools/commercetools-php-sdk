<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class SuggestTokenizer
 * @package Sphere\Core\Model\Product
 * @method string getType()
 * @method SuggestTokenizer setType(string $type)
 * @method array getInputs()
 * @method SuggestTokenizer setInputs(array $inputs)
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
