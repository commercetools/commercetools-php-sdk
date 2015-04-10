<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class JsonDeserializeTrait
 * @package Sphere\Core\Model\Common
 */
trait JsonDeserializeTrait
{
    abstract protected function initialize($field);

    protected $rawData = [];
    protected $typeData = [];
    protected $initialized = [];

    protected function getDeserializeInterface()
    {
        return 'Sphere\Core\Model\Common\JsonDeserializeInterface';
    }

    protected static $primitives = [
        'bool' => 'is_bool',
        'int' => 'is_int',
        'string' => 'is_string',
        'float' => 'is_float',
        'array' => 'is_array'
    ];

    protected static $interfaces = [];

    /**
     * @param $type
     * @return mixed
     * @internal
     */
    protected function hasInterface($type)
    {
        if (!isset(static::$interfaces[$type])) {
            $interface = false;
            if (
                $this->isPrimitive($type) === false
                && isset(class_implements($type)[$this->getDeserializeInterface()])
            ) {
                $interface = true;
            }
            static::$interfaces[$type] = $interface;
        }
        return static::$interfaces[$type];
    }

    /**
     * @param $type
     * @return string|false
     * @internal
     */
    protected function isPrimitive($type)
    {
        if (!isset(static::$primitives[$type])) {
            return false;
        }

        return static::$primitives[$type];
    }

    /**
     * @param string $type
     * @param mixed $value
     * @return bool
     * @internal
     */
    protected function isType($type, $value)
    {
        if ($typeFunction = $this->isPrimitive($type)) {
            return $typeFunction($value);
        }
        return $value instanceof $type;
    }

    protected function isDeserializable($value)
    {
        return (is_object($value) && $this->hasInterface(get_class($value)));
    }

    protected function isDeserializableType($type)
    {
        if (!is_string($type)) {
            return false;
        }
        return $this->hasInterface($type);
    }

    protected function getTyped($offset)
    {
        if (!isset($this->initialized[$offset])) {
            $this->initialize($offset);
        }
        if (array_key_exists($offset, $this->typeData)) {
            return $this->typeData[$offset];
        }
        return $this->rawData[$offset];
    }
}
