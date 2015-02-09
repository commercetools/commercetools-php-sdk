<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:54
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Error\Message;

/**
 * Class JsonObject
 * @package Sphere\Core\Model\Type
 */
class JsonObject implements \JsonSerializable, JsonDeserializeInterface
{
    const TYPE = 'type';
    const OPTIONAL = 'optional';
    const INITIALIZED = 'initialized';
    const DESERIALIZE = 'Sphere\Core\Model\Common\JsonDeserializeInterface';

    protected $rawData = [];
    protected $typeData = [];
    protected $initialized = [];

    protected static $interfaces = [];

    public function __construct(array $data = null)
    {
        if (!is_null($data)) {
            $this->rawData = $data;
        }
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
     * @return array
     * @internal
     */
    public function getFields()
    {
        return [];
    }

    /**
     * @return array
     * @internal
     */
    protected function getPrimitives()
    {
        return [
            'bool' => 'is_bool',
            'int' => 'is_int',
            'string' => 'is_string',
            'float' => 'is_float',
            'array' => 'is_array'
        ];
    }

    /**
     * @param $method
     * @param $arguments
     * @return $this|bool|mixed
     * @internal
     */
    public function __call($method, $arguments)
    {
        $action = substr($method, 0, 3);
        $field = lcfirst(substr($method, 3));

        if (!$this->hasField($field)) {
            throw new \BadMethodCallException(
                sprintf(Message::UNKNOWN_FIELD, $field, $method, implode(', ', $arguments))
            );
        }
        switch ($action) {
            case 'get':
                return $this->get($field);
            case 'set':
                $this->set($field, isset($arguments[0]) ? $arguments[0] : null);
                return $this;
            default:
                throw new \BadMethodCallException(sprintf(Message::UNKNOWN_METHOD, $method, $field));
        }
    }

    /**
     * @param string $field
     * @return bool
     * @internal
     */
    protected function hasField($field)
    {
        if (isset($this->getFields()[$field])) {
            return true;
        }
        return false;
    }

    /**
     * @param string $field
     * @return array
     * @internal
     */
    protected function getField($field)
    {
        return $this->getFields()[$field];
    }

    /**
     * @param $field
     * @param $key
     * @return bool
     * @internal
     */
    protected function getFieldKey($field, $key)
    {
        $field = $this->getField($field);

        if (isset($field[$key])) {
            return $field[$key];
        }

        return false;
    }

    /**
     * @param $field
     * @return bool
     * @internal
     */
    protected function isInitialized($field)
    {
        return isset($this->initialized[$field]);
    }

    /**
     * @param string $field
     * @return mixed
     * @internal
     */
    public function get($field)
    {
        if (!$this->isInitialized($field)) {
            $this->initialize($field);
        }
        if (isset($this->typeData[$field])) {
            return $this->typeData[$field];
        }
        return $this->rawData[$field];
    }

    /**
     * @param $field
     * @internal
     */
    public function initialize($field)
    {
        $type = $this->getFieldKey($field, static::TYPE);
        if ($type && $this->hasInterface($type)) {
            /**
             * @var JsonDeserializeInterface $type
             */
            $this->typeData[$field] = $type::fromArray($this->rawData[$field]);
        }
        $this->initialized[$field] = true;
    }

    /**
     * @param $type
     * @return mixed
     * @internal
     */
    protected function hasInterface($type)
    {
        if (!isset(static::$interfaces[$type])) {
            $interface = false;
            if (!$this->isPrimitive($type) && isset(class_implements($type)[static::DESERIALIZE])) {
                $interface = true;
            }
            static::$interfaces[$type] = $interface;
        }
        return static::$interfaces[$type];
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     * @internal
     */
    public function set($field, $value)
    {
        $type = $this->getFieldKey($field, static::TYPE);
        if ($type && $value !== null && !$this->isType($type, $value)) {
            throw new \InvalidArgumentException(sprintf(Message::WRONG_TYPE, $field, $type));
        }
        if ($value === null && !$this->getFieldKey($field, static::OPTIONAL)) {
            throw new \InvalidArgumentException(sprintf(Message::EXPECTS_PARAMETER, $field, $type));
        }
        $this->typeData[$field] = $value;
        $this->initialized[$field] = true;

        return $this;
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
     * @param $type
     * @return string|false
     * @internal
     */
    protected function isPrimitive($type)
    {
        if (!isset($this->getPrimitives()[$type])) {
            return false;
        }

        return $this->getPrimitives()[$type];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->rawData, $this->typeData);
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
     * @return static
     */
    public static function of()
    {
        return new static();
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }
}
