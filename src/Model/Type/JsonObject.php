<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:54
 */

namespace Sphere\Core\Model\Type;


/**
 * Class JsonObject
 * @package Sphere\Core\Model\Type
 */
class JsonObject implements \JsonSerializable
{
    /**
     * @return array
     */
    public function toArray()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
