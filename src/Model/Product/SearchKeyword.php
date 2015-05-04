<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class SearchKeyword
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products.html#search-keyword
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getText();
    }
}
