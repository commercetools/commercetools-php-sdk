<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:44
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Http\JsonEndpoint;
use Sphere\Core\Response\AbstractApiResponse;
use Sphere\Core\Response\PagedQueryResponse;

abstract class AbstractSuggestRequest extends AbstractApiRequest
{
    use PageTrait;
    use SortTrait;
    use StagedTrait;

    /**
     * @param JsonEndpoint $endpoint
     * @param string $sort
     * @param int $limit
     * @param bool $staged
     */
    public function __construct(JsonEndpoint $endpoint, $sort = null, $limit = null, $staged = false)
    {
        parent::__construct($endpoint);
        $this->setSearchParams($sort, $limit, $staged);
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param bool $staged
     */
    public function setSearchParams($sort, $limit, $staged)
    {
        $this->sort($sort)->limit($limit)->staged($staged);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/suggest?' . $this->getParamString();
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
     * @return AbstractApiResponse
     */
    public function buildResponse($response)
    {
        return new PagedQueryResponse($response, $this);
    }
}
