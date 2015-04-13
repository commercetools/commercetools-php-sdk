<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class AbstractJsonDeserializeObject
 * @package Sphere\Core\Model\Common
 */
abstract class AbstractJsonDeserializeObject implements JsonDeserializeInterface
{
    abstract protected function initialize($field);

    protected $rawData = [];
    protected $typeData = [];
    protected $initialized = [];

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        $this->setContext($context);
        if (!is_null($data)) {
            $this->rawData = $data;
        }
    }

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

    /**
     * @var bool[]
     */
    protected static $interfaces = [];

    /**
     * @param $type
     * @return bool
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
     * @param string|bool $type
     * @param mixed $value
     * @return bool
     */
    protected function isValidType($type, $value)
    {
        return !is_string($type) || is_null($value) || $this->isType($type, $value);
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

    /**
     * @param $value
     * @return bool
     */
    protected function isDeserializable($value)
    {
        return (is_object($value) && $this->hasInterface(get_class($value)));
    }

    /**
     * @param $type
     * @return bool
     */
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

    /**
     * @param array $rawData
     * @internal
     */
    public function setRawData(array $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @param $field
     * @param $default
     * @return mixed
     */
    protected function getRaw($field, $default = null)
    {
        return isset($this->rawData[$field])? $this->rawData[$field]: $default;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->rawData, $this->typeData);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        return new static($data, $context);
    }

    /**
     * @return static
     */
    public static function of()
    {
        return new static();
    }
}
