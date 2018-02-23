<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Error\Message;

/**
 * @package Commercetools\Core\Model\Common
 */
class Collection extends AbstractJsonDeserializeObject implements \Iterator, \JsonSerializable, \Countable, \ArrayAccess
{
    const ID = 'id';
    use ContextTrait;
    const COLLECTION_TYPE = Collection::TYPE_LIST;
    const TYPE_LIST = 'List';
    const TYPE_MAP = 'Map';

    /**
     * @var string
     */
    protected $type;

    protected $pos = 0;

    protected $keys = [];

    protected $index = [];

    /**
     * @param array $data
     * @param Context|callable $context
     */
    final public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->indexData();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @internal
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    protected function indexData()
    {
        $this->keys = array_keys($this->rawData);
        foreach ($this->rawData as $offset => $row) {
            $this->indexRow($offset, $row);
        }
    }

    /**
     * @param array $rawData
     * @internal
     * @return $this
     */
    public function setRawData(array $rawData)
    {
        parent::setRawData($rawData);
        $this->indexData();

        return $this;
    }

    /**
     * @param string $indexName
     * @param int $offset
     * @param $key
     */
    protected function addToIndex($indexName, $offset, $key)
    {
        if (!is_null($key)) {
            $this->index[$indexName][$key] = $offset;
        }
    }

    protected function indexRow($offset, $row)
    {
        $id = null;
        if ($row instanceof Resource) {
            $id = $row->getId();
        } elseif (is_array($row)) {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
    }

    /**
     * @param $id
     * @return static
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }

    /**
     * @param $indexName
     * @param $key
     * @return mixed|null
     */
    public function getBy($indexName, $key)
    {
        if (isset($this->index[$indexName][$key])) {
            $key = $this->index[$indexName][$key];

            return $this->getAt($key);
        }
        return null;
    }

    public function add($object)
    {
        $this->setAt(null, $object);

        return $this;
    }

    /**
     * @param $offset
     * @internal
     */
    protected function initialize($offset)
    {
        $type = $this->getType();
        if ($this->isDeserializableType($type)) {
            /**
             * @var JsonDeserializeInterface $type
             */
            $value = $type::fromArray($this->getRaw($offset), $this->getContextCallback());
            if ($value instanceof ObjectTreeInterface) {
                $value->parentSet($this);
                $value->rootSet($this->rootGet());
            }
            $this->typeData[$offset] = $value;
        }
        $this->initialized[$offset] = true;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $values = [];
        foreach ($this->typeData as $key => $value) {
            if ($value instanceof JsonDeserializeInterface) {
                $values[$key] = $value->toArray();
            } else {
                $values[$key] = $value;
            }
        }

        return $values;
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function getAt($offset)
    {
        return $this->getTyped($offset);
    }

    /**
     * @param $offset
     * @param mixed $default
     * @return array
     */
    protected function getRaw($offset, $default = [])
    {
        return parent::getRaw($offset, $default);
    }

    /**
     * @param $offset
     * @param $object
     * @return $this
     */
    public function setAt($offset, $object)
    {
        $type = $this->getType();
        if (!$this->isValidType($type, $object)) {
            throw new \InvalidArgumentException(sprintf(Message::WRONG_TYPE, $offset, $type));
        }

        if ($object instanceof ContextAwareInterface) {
            $object->setContext($this->getContextCallback());
        }
        if ($object instanceof ObjectTreeInterface) {
            $object->parentSet($this);
            $object->rootSet($this->rootGet());
        }
        if (is_null($offset)) {
            $this->typeData[] = $object;
            $offset = count($this->typeData) - 1;
        } else {
            $this->typeData[$offset] = $object;
        }
        $this->initialized[$offset] = true;
        if (!in_array($offset, $this->keys)) {
            $this->keys[] = $offset;
        }
        $this->indexRow($offset, $object);

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        $rawKeys = array_keys($this->rawData);
        $typeKeys = array_keys($this->typeData);
        $keys = array_merge($rawKeys, $typeKeys);
        $uniqueKeys = array_unique($keys);
        return count($uniqueKeys);
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        if (isset($this->keys[$this->pos])) {
            return $this->getAt($this->keys[$this->pos]);
        }
        return null;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->pos++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        if (isset($this->keys[$this->pos])) {
            return $this->keys[$this->pos];
        }
        return null;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if (isset($this->keys[$this->pos])) {
            return $this->offsetExists($this->keys[$this->pos]);
        }
        return false;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->pos = 0;
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
        unset($this->rawData[$offset]);
        unset($this->typeData[$offset]);
        $rawKeys = array_keys($this->rawData);
        $typeKeys = array_keys($this->typeData);
        $keys = array_merge($rawKeys, $typeKeys);
        $this->keys = array_unique($keys);
    }

    protected function toJson()
    {
        $data = parent::toJson();

        if (static::COLLECTION_TYPE == self::TYPE_LIST) {
            return array_values($data);
        }

        return $data;
    }
}
