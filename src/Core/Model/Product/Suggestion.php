<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products-search.html#suggestion
 * @method string getText()
 * @method Suggestion setText(string $text = null)
 */
class Suggestion extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'text' => [static::TYPE => 'string']
        ];
    }
}
