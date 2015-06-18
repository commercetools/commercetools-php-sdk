<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 09:26
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\ContextAwareInterface;
use Sphere\Core\Model\Common\ContextTrait;
use Sphere\Core\Model\Product\ProductProjectionCollection;
use Sphere\Core\Request\ClientRequestInterface;
use Traversable;

/**
 * Class PagedQueryResponse
 * @package Sphere\Core\Response
 */
class PagedQueryResponse extends AbstractApiResponse implements \IteratorAggregate, \ArrayAccess
{
    const COUNT = 'count';
    const OFFSET = 'offset';
    const TOTAL = 'total';
    const RESULTS = 'results';

    protected $count;
    protected $offset;
    protected $total;
    protected $results;

    protected function getResponseKey($key, $default = null)
    {
        $response = $this->toArray();
        if (isset($response[$key])) {
            return $response[$key];
        }

        return $default;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        if (is_null($this->count)) {
            $this->count = $this->getResponseKey(static::COUNT);
        }
        return $this->count;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        if (is_null($this->offset)) {
            $this->offset = $this->getResponseKey(static::OFFSET);
        }
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        if (is_null($this->total)) {
            $this->total = $this->getResponseKey(static::TOTAL);
        }
        return $this->total;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        if (is_null($this->results)) {
            $this->results = $this->getResponseKey(static::RESULTS, []);
        }
        return $this->results;
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
        $this->getResults();
        return new \ArrayIterator($this->results);
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
        $results = $this->getResults();
        return isset($results[$offset]);
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
        $results = $this->getResults();
        return $results[$offset];
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
        $this->getResults();
        if (is_null($offset)) {
            $this->results[] = $value;
        } else {
            $this->results[$offset] = $value;
        }
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
        $this->getResults();
        unset($this->results[$offset]);
    }
}
