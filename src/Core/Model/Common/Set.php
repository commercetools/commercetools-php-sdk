<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#attribute
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#settype
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#attributetype
 */
class Set extends Collection implements TypeableInterface
{
    /**
     * @param $offset
     * @internal
     */
    protected function initialize($offset)
    {
        parent::initialize($offset);

        $type = $this->getType();
        if ($this->isPrimitive($type) === false && $this->isDeserializableType($type) === false) {
            $value = new $type($this->typeData[$offset]);
            $this->typeData[$offset] = $value;
        }
    }

    /**
     * @param $type
     * @param Context|callable $context
     * @return $this
     */
    public static function ofType($type, $context = null)
    {
        $set = static::of($context);
        return $set->setType($type);
    }

    /**
     * @param $type
     * @param array $data
     * @param Context|callable $context
     * @return $this
     */
    public static function ofTypeAndData($type, array $data, $context = null)
    {
        return static::ofType($type, $context)->setRawData($data);
    }


    public function __toString()
    {
        $values = [];
        foreach ($this as $set) {
            $values[] = (string)$set;
        }
        return implode(', ', $values);
    }
}
