<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#search-keyword
 * @method string getText()
 * @method SearchKeyword setText(string $text = null)
 * @method SuggestTokenizer getSuggestTokenizer()
 * @method SearchKeyword setSuggestTokenizer(SuggestTokenizer $suggestTokenizer = null)
 */
class SearchKeyword extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'text' => [static::TYPE => 'string'],
            'suggestTokenizer' => [static::TYPE => '\Commercetools\Core\Model\Product\SuggestTokenizer'],
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
