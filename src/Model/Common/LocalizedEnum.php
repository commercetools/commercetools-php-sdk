<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class LocalizedEnum
 * @package Sphere\Core\Model\Common
 */
class LocalizedEnum extends JsonObject
{
    public function getFields()
    {
        return [
            'label' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'key' => [static::TYPE => 'string']
        ];
    }
}
