<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class SearchKeyword
 * @package Sphere\Core\Model\Product
 * @method string getText()
 * @method SearchKeyword setText(string $text = null)
 * @method SuggestTokenizer getSuggestTokenizer()
 * @method SearchKeyword setSuggestTokenizer(SuggestTokenizer $suggestTokenizer = null)
 */
class SearchKeyword extends JsonObject
{
    public function getFields()
    {
        return [
            'text' => [static::TYPE => 'string'],
            'suggestTokenizer' => [static::TYPE => '\Sphere\Core\Model\Product\SuggestTokenizer'],
        ];
    }
}
