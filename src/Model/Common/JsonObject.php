<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:54
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Error\Message;

/**
 * @package Commercetools\Core\Model\Type
 */
class JsonObject extends AbstractJsonDeserializeObject implements \JsonSerializable
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
    public function fieldDefinitions()
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
            if ($action == 'get' || $action == 'set') {
                throw new \BadMethodCallException(
                    sprintf(Message::UNKNOWN_FIELD, $field, $method, implode(', ', $arguments))
                );
            } else {
                throw new \BadMethodCallException(sprintf(Message::UNKNOWN_METHOD, $method, $field));
            }
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
        if (isset($this->fieldDefinitions()[$field])) {
            return true;
        }
        return false;
    }

    /**
     * @param string $field
     * @return array
     * @internal
     */
    protected function fieldDefinition($field)
    {
        return $this->fieldDefinitions()[$field];
    }

    /**
     * @param string $field
     * @param string $key
     * @param $default
     * @return bool|string
     * @internal
     */
    protected function fieldDefinitionValue($field, $key, $default = false)
    {
        $field = $this->fieldDefinition($field);

        if (isset($field[$key])) {
            return $field[$key];
        }

        return $default;
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

    protected function fieldDefinitionType($field)
    {
        return $this->fieldDefinitionValue($field, static::TYPE);
    }
    /**
     * @param string $field
     * @internal
     */
    protected function initialize($field)
    {
        $type = $this->fieldDefinitionType($field);
        if ($this->isTypeableType($type)) {
            /**
             * @var TypeableInterface $type
             */
            $value = $type::ofTypeAndData(
                $this->fieldDefinitionValue($field, static::ELEMENT_TYPE),
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
        if ($value instanceof ObjectTreeInterface) {
            $value->parentSet($this);
            $value->rootSet($this->rootGet());
        }
        $this->typeData[$field] = !is_null($value) ? $this->decorateField($field, $value) : null;

        $this->initialized[$field] = true;
    }

    public function isOptional($field)
    {
        return $this->fieldDefinitionValue($field, static::OPTIONAL, false);
    }

    protected function decorateField($field, $value)
    {
        if ($decorator = $this->fieldDefinitionValue($field, static::DECORATOR)) {
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
        $type = $this->fieldDefinitionType($field);
        if (!$this->isValidType($type, $value)) {
            throw new \InvalidArgumentException(sprintf(Message::WRONG_TYPE, $field, $type));
        }
        if ($value === null && !$this->isOptional($field)) {
            throw new \InvalidArgumentException(sprintf(Message::EXPECTS_PARAMETER, $field, $type));
        }
        if ($value instanceof ContextAwareInterface) {
            $value->setContext($this->getContextCallback());
        }
        if ($value instanceof ObjectTreeInterface) {
            $value->parentSet($this);
            $value->rootSet($this->rootGet());
        }
        $this->typeData[$field] = $this->decorateField($field, $value);

        $this->initialized[$field] = true;

        return $this;
    }
}
