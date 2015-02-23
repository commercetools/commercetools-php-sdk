<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Error\Message;
use Traversable;

/**
 * Class Collection
 * @package Sphere\Core\Model\Common
 */
class Collection implements \IteratorAggregate, \JsonSerializable, JsonDeserializeInterface, \ArrayAccess
{
    use ContextTrait;

    const DESERIALIZE = 'Sphere\Core\Model\Common\JsonDeserializeInterface';

    protected $type;

    protected static $primitives = [
        'bool' => 'is_bool',
        'int' => 'is_int',
        'string' => 'is_string',
        'float' => 'is_float',
        'array' => 'is_array'
    ];

    protected $rawData = [];
    protected $typeData = [];
    protected $initialized = [];

    protected static $interfaces = [];

    public function __construct(array $data = [], Context $context = null)
    {
        $this->setContext($context);
        $this->rawData = $data;
    }


    public function add($object)
    {
        $this->setAt(null, $object);

        return $this;
    }

    public function toArray()
    {
        return array_merge($this->rawData, $this->typeData);
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
            if ($this->isPrimitive($type) === false && isset(class_implements($type)[static::DESERIALIZE])) {
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
     * @param $offset
     * @internal
     */
    protected function initialize($offset)
    {
        $type = $this->type;
        if ($type !== false && $this->hasInterface($type)) {
            /**
             * @var JsonDeserializeInterface $type
             */
            $this->typeData[$offset] = $type::fromArray($this->getRaw($offset), $this->getContext());
        }
        $this->initialized[$offset] = true;
    }

    /**
     * @param $offset
     * @return mixed
     * @internal
     */
    public function getAt($offset)
    {
        if (!isset($this->initialized[$offset])) {
            $this->initialize($offset);
        }
        if (isset($this->typeData[$offset])) {
            return $this->typeData[$offset];
        }
        return $this->rawData[$offset];
    }

    /**
     * @param $offset
     * @return array
     */
    protected function getRaw($offset)
    {
        return isset($this->rawData[$offset])? $this->rawData[$offset]: [];
    }

    /**
     * @param $offset
     * @param $object
     * @return $this
     */
    public function setAt($offset, $object)
    {
        $type = $this->type;
        if (!is_null($type) && !is_null($object) && !$this->isType($type, $object)) {
            throw new \InvalidArgumentException(sprintf(Message::WRONG_TYPE, $offset, $type));
        }
        if ($this->hasInterface(get_class($object))) {
            /**
             * @var JsonDeserializeInterface $object
             */
            $object->setContext($this->getContext());
        }
        if (is_null($offset)) {
            $this->typeData[] = $object;
            $offset = count($this->typeData) - 1;
        } else {
            $this->typeData[$offset] = $object;
        }
        $this->initialized[$offset] = true;

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
     * @param array $data
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        return new static($data, $context);
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
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->rawData);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->rawData[$offset]) || isset($this->typeData[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->getAt($offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->setAt($offset, $value);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->setAt($offset, null);
    }
}
