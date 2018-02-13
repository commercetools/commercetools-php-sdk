<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @method int getW()
 * @method AssetDimension setW(int $w = null)
 * @method int getH()
 * @method AssetDimension setH(int $h = null)
 */
class AssetDimension extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'w' => [static::TYPE => 'int'],
            'h' => [static::TYPE => 'int'],
        ];
    }
}
