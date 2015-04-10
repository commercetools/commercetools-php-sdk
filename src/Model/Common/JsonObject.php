<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:54
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Error\Message;

/**
 * Class JsonObject
 * @package Sphere\Core\Model\Type
 */
class JsonObject implements \JsonSerializable, JsonDeserializeInterface
{
    use ContextTrait;
    use JsonDeserializeTrait;

    const TYPE = 'type';
    const OPTIONAL = 'optional';
    const INITIALIZED = 'initialized';
    const DECORATOR = 'decorator';

    protected $rawData = [];
    protected $typeData = [];
    protected $initialized = [];

    public function __construct(array $data = null, $context = null)
    {
        if (!is_null($data)) {
            $this->rawData = $data;
        }
        $this->setContext($context);
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
     * @param string $field
     * @param string $key
     * @return string|bool
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
     * @param string $field
     * @return mixed
     * @internal
     */
    public function get($field)
    {
        if (!isset($this->initialized[$field])) {
            $this->initialize($field);
        }
        if (array_key_exists($field, $this->typeData)) {
            return $this->typeData[$field];
        }
        return $this->rawData[$field];
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
     * @param string $field
     * @internal
     */
    protected function initialize($field)
    {
        $type = $this->getFieldKey($field, static::TYPE);
        if ($this->isDeserializableType($type)) {
            /**
             * @var JsonDeserializeInterface $type
             */
            $value = $type::fromArray($this->getRaw($field, []), $this->getContextCallback());
        } else {
            $value = $this->getRaw($field);
        }
        $this->typeData[$field] = $this->decorateField($field, $value);

        $this->initialized[$field] = true;
    }

    protected function isValidType($type, $value)
    {
        if (!is_string($type)) {
            return true;
        }
        if (is_null($value)) {
            return true;
        }
        return $this->isType($type, $value);
    }

    protected function isOptional($field, $value)
    {
        return ($value === null && $this->getFieldKey($field, static::OPTIONAL) === false);
    }

    protected function decorateField($field, $value)
    {
        if ($decorator = $this->getFieldKey($field, static::DECORATOR)) {
            $value = new $decorator($value);
        }

        return $value;
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
        if (!$this->isValidType($type, $value)) {
            throw new \InvalidArgumentException(sprintf(Message::WRONG_TYPE, $field, $type));
        }
        if ($this->isOptional($field, $value)) {
            throw new \InvalidArgumentException(sprintf(Message::EXPECTS_PARAMETER, $field, $type));
        }
        if ($this->isDeserializable($value)) {
            /**
             * @var JsonDeserializeInterface $value
             */
            $value->setContext($this->getContextCallback());
        }
        $this->typeData[$field] = $this->decorateField($field, $value);

        $this->initialized[$field] = true;

        return $this;
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
}
