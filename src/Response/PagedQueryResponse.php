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

    protected $parsed = false;
    protected $count;
    protected $offset;
    protected $total;
    protected $results = [];

    protected function parseJsonResponse()
    {
        if ($this->parsed) {
            return;
        }
        $this->parsed = true;
        if (!$this->isError()) {
            $jsonResponse = $this->toArray();
            $this->setCount($jsonResponse[static::COUNT])
                ->setOffset($jsonResponse[static::OFFSET])
                ->setTotal($jsonResponse[static::TOTAL])
                ->setResults($jsonResponse[static::RESULTS])
            ;
        }
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $this->parseJsonResponse();
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    protected function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        $this->parseJsonResponse();
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    protected function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        $this->parseJsonResponse();
        return $this->total;
    }

    /**
     * @param int $total
     * @return $this
     */
    protected function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        $this->parseJsonResponse();
        return $this->results;
    }

    /**
     * @param array $results
     * @return $this
     */
    protected function setResults(array $results)
    {
        $this->results = $results;

        return $this;
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
        $this->parseJsonResponse();
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
        $this->parseJsonResponse();
        return isset($this->results[$offset]);
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
        $this->parseJsonResponse();
        return $this->results[$offset];
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
        $this->parseJsonResponse();
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
        $this->parseJsonResponse();
        unset($this->results[$offset]);
    }
}
