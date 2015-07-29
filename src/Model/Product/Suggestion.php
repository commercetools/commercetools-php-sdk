<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Product
 * @apidoc http://dev.sphere.io/http-api-projects-products-search.html#suggest-representations-suggestion
 * @method string getText()
 * @method Suggestion setText(string $text = null)
 */
class Suggestion extends JsonObject
{
    public function getFields()
    {
        return [
            'text' => [static::TYPE => 'string']
        ];
    }
}
