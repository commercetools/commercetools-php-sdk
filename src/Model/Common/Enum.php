<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Enum
 * @package Sphere\Core\Model\Common
 */
class Enum extends JsonObject
{
    public function getFields()
    {
        return [
            'label' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string']
        ];
    }
}
