<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

use Traversable;

class Collection implements \IteratorAggregate, \JsonSerializable, JsonDeserializeInterface
{
    protected $type;

    protected $data;

    public function __construct(array $data = null)
    {
        $this->data = $data;
    }


    public function add($object)
    {
        $type = $this->type;
        if ($type && !($object instanceof $type)) {
            throw new \InvalidArgumentException();
        }
        $this->data[] = $object;
    }

    public function toArray()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data)
    {
        return new static($data);
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
        return new \ArrayIterator($this->data);
    }
}
