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
class JsonObject extends AbstractJsonDeserializeObject implements \JsonSerializable, JsonDeserializeInterface
{
    use ContextTrait;

    const TYPE = 'type';
    const OPTIONAL = 'optional';
    const INITIALIZED = 'initialized';
    const DECORATOR = 'decorator';
    const ELEMENT_TYPE = 'elementType';

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
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

    public function __get($field)
    {
        if (!$this->hasField($field)) {
            throw new \BadMethodCallException(
                sprintf(Message::UNKNOWN_FIELD, $field, 'get', $field)
            );
        }
        return $this->get($field);
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
        return $this->getTyped($field);
    }

    /**
     * @param string $field
     * @internal
     */
    protected function initialize($field)
    {
        $type = $this->getFieldKey($field, static::TYPE);
        if ($this->isTypeableType($type)) {
            /**
             * @var TypeableInterface $type
             */
            $value = $type::ofTypeAndData(
                $this->getFieldKey($field, static::ELEMENT_TYPE),
                $this->getRaw($field, []),
                $this->getContextCallback()
            );
        } elseif ($this->isDeserializableType($type)) {
            /**
             * @var JsonDeserializeInterface $type
             */
            $value = $this->getRaw($field, null);
            if (!is_null($value)) {
                $value = $type::fromArray($value, $this->getContextCallback());
            }
        } else {
            $value = $this->getRaw($field);
        }
        $this->typeData[$field] = !is_null($value) ? $this->decorateField($field, $value) : null;

        $this->initialized[$field] = true;
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
}
