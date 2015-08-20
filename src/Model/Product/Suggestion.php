<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products-search.html#suggest-representations-suggestion
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
