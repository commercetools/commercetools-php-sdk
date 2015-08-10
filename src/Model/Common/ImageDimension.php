<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-images
 * @method int getW()
 * @method ImageDimension setW(int $w = null)
 * @method int getH()
 * @method ImageDimension setH(int $h = null)
 */
class ImageDimension extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'w' => [static::TYPE => 'int'],
            'h' => [static::TYPE => 'int'],
        ];
    }
}
