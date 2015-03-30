<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class ImageDimension
 * @package Sphere\Core\Model\Common
 * @method int getW()
 * @method ImageDimension setW(int $w = null)
 * @method int getH()
 * @method ImageDimension setH(int $h = null)
 */
class ImageDimension extends JsonObject
{
    public function getFields()
    {
        return [
            'w' => [static::TYPE => 'int'],
            'h' => [static::TYPE => 'int'],
        ];
    }
}
