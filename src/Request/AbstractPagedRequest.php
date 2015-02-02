<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 15:35
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\Response\PagedQueryResponse;

abstract class AbstractPagedRequest extends AbstractApiRequest
{
    use PageTrait;
    use SortTrait;

    public function __construct(JsonEndpoint $endpoint, $sort = null, $limit = null, $offset = null)
    {
        parent::__construct($endpoint);
        $this->setQueryParams($sort, $limit, $offset);
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function setQueryParams($sort, $limit, $offset)
    {
        $this->sort($sort)
            ->limit($limit)
            ->offset($offset);

        return $this;
    }

    /**
     * @return HttpRequest
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
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
