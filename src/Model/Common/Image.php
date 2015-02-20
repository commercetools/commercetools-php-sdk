<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Image
 * @package Sphere\Core\Model\Common
 * @method string getUrl()
 * @method Image setUrl(string $url)
 * @method array getDimensions()
 * @method Image setDimensions(array $dimensions)
 * @method string getLabel()
 * @method Image setLabel(string $label)
 */
class Image extends JsonObject
{
    public function getFields()
    {
        return [
            'url' => [static::TYPE => 'string'],
            'dimensions' => [static::TYPE => 'array'],
            'label' => [static::TYPE => 'string']
        ];
    }
}
