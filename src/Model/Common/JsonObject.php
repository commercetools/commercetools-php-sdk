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
class JsonObject implements \JsonSerializable
{
    const TYPE = 'type';
    const OPTIONAL = 'optional';

    protected $data = [];

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
        preg_match('/^([a-z]+)(.+)/', $method, $matches);
        $action = $matches[1];
        $field = lcfirst($matches[2]);

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
            case 'has':
                return array_key_exists($field, $this->data);
            case 'is':
                return (bool)$this->data[$field];
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
        return $this->data[$field];
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
        $this->data[$field] = $value;

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
        $typeFunction = 'is_' . $type;
        if (!is_object($value) && function_exists($typeFunction)) {
            return $typeFunction($value);
        }
        return $value instanceof $type;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
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
