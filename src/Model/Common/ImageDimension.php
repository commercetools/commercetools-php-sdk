<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#product-images
 * @method int getW()
 * @method ImageDimension setW(int $w = null)
 * @method int getH()
 * @method ImageDimension setH(int $h = null)
 */
class ImageDimension extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'w' => [static::TYPE => 'int'],
            'h' => [static::TYPE => 'int'],
        ];
    }
}
