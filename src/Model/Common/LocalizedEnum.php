<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


/**
 * Class LocalizedEnum
 * @package Sphere\Core\Model\Common
 * @method LocalizedString getLabel()
 * @method LocalizedEnum setLabel(LocalizedString $label = null)
 * @method string getKey()
 * @method LocalizedEnum setKey(string $key = null)
 */
class LocalizedEnum extends JsonObject
{
    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'label' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'key' => [static::TYPE => 'string']
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getLabel()->__toString();
    }
}
