<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-variant-attribute
 * @method string getLabel()
 * @method Enum setLabel(string $label = null)
 * @method string getKey()
 * @method Enum setKey(string $key = null)
 */
class Enum extends JsonObject
{
    /**
     * @return array
     */
    public function fieldDefinitions()
    {
        return [
            'label' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string']
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLabel();
    }
}
