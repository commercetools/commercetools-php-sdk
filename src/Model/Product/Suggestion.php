<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class Suggestion
 * @package Sphere\Core\Model\Product
 * @method string getText()
 * @method Suggestion setText(string $text)
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
