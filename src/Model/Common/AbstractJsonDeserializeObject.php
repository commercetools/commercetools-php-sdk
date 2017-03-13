<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 */
abstract class AbstractJsonDeserializeObject implements JsonDeserializeInterface, ObjectTreeInterface
{
    use ObjectTreeTrait;

    const JSON_DESERIALIZE_INTERFACE = JsonDeserializeInterface::class;
    const TYPEABLE_INTERFACE = TypeableInterface::class;

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
            $this->rawData = $this->typeData = $data;
        }
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

    public function __sleep()
    {
        return array_diff(array_keys(get_object_vars($this)), ['context']);
    }

    /**
     * @param $type
     * @param $interfaceName
     * @return bool
     * @internal
     */
    protected function hasInterface($type, $interfaceName)
    {
        $interfaceName = trim($interfaceName, '\\');
        $cacheKey = $interfaceName . '-' . $type;
        if (!isset(static::$interfaces[$cacheKey])) {
            $interface = false;
            if ($this->isPrimitive($type) === false
                && isset(class_implements($type)[$interfaceName])
            ) {
                $interface = true;
            }
            static::$interfaces[$cacheKey] = $interface;
        }
        return static::$interfaces[$cacheKey];
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
        return (is_object($value) && $this->hasInterface(get_class($value), static::JSON_DESERIALIZE_INTERFACE));
    }

    /**
     * @param $type
     * @return bool
     */
    protected function isDeserializableType($type)
    {
        if (!is_string($type) || empty($type)) {
            return false;
        }
        return $this->hasInterface($type, static::JSON_DESERIALIZE_INTERFACE);
    }

    protected function isTypeableType($type)
    {
        if (!is_string($type) || empty($type)) {
            return false;
        }
        return $this->hasInterface($type, static::TYPEABLE_INTERFACE);
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
     * @return $this
     */
    public function setRawData(array $rawData)
    {
        $this->rawData = $this->typeData = $rawData;

        return $this;
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
        return $this->toJson();
    }

    /**
     * @return array
     */
    protected function toJson()
    {
        $data = array_filter($this->typeData, function ($value) {
            return !is_null($value);
        });

        return $data;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = array_filter($this->typeData, function ($value) {
            return !is_null($value);
        });
        $data = array_map(
            function ($value) {
                if ($value instanceof JsonDeserializeInterface) {
                    return $value->toArray();
                }
                return $value;
            },
            $data
        );
        return $data;
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
     * @param Context|callable $context
     * @return static
     */
    final public static function of($context = null)
    {
        return new static([], $context);
    }
}
