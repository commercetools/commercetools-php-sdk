<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#searchkeyword
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
            'suggestTokenizer' => [static::TYPE => SuggestTokenizer::class],
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
