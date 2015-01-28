<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 28.01.15, 09:26
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;
use Sphere\Core\Http\ClientRequestInterface;
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

    public function __construct(ResponseInterface $response, ClientRequestInterface $request)
    {
        parent::__construct($response, $request);
        if (!$this->isError()) {
            $jsonResponse = $this->json();
            $this->setCount($jsonResponse[static::COUNT])
                ->setOffset($jsonResponse[static::OFFSET])
                ->setTotal($jsonResponse[static::TOTAL])
                ->setResults($jsonResponse[static::RESULTS])
            ;
        }
    }


    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param $results
     * @return $this
     */
    public function setResults($results)
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
        $this->results[$offset] = $value;
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
        unset($this->results[$offset]);
    }
}
