<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:27
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Response\PagedQueryResponse;

/**
 * Class AbstractQueryRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractQueryRequest extends AbstractApiRequest
{
    use QueryTrait;
    use PageTrait;
    use SortTrait;

    /**
     * @param $where
     * @param $sort
     * @param $limit
     * @param $offset
     */
    public function __construct($endpoint, $where = null, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct($endpoint);
        $this->setQueryParams($where, $sort, $limit, $offset);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '?' . $this->getParamString();
    }

    /**
     * @return HttpRequest
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param $where
     * @param $sort
     * @param $limit
     * @param $offset
     */
    public function setQueryParams($where, $sort, $limit, $offset)
    {
        $this->where($where)->sort($sort)->limit($limit)->offset($offset);
    }

    /**
     * @param $response
     * @return PagedQueryResponse
     */
    public function buildResponse($response)
    {
        return new PagedQueryResponse($response, $this);
    }
}
