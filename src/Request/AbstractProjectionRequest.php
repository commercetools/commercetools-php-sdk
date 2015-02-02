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

abstract class AbstractProjectionRequest extends AbstractApiRequest
{
    use PageTrait;
    use SortTrait;
    use StagedTrait;

    /**
     * @param JsonEndpoint $endpoint
     * @param bool $staged
     * @param string $sort
     * @param int $limit
     * @param int $offset
     */
    public function __construct(JsonEndpoint $endpoint, $sort = null, $limit = null, $offset = null, $staged = false)
    {
        parent::__construct($endpoint);
        $this->setSearchParams($sort, $limit, $offset, $staged);
    }

    /**
     * @param string $sort
     * @param int $limit
     * @param int $offset
     * @param bool $staged
     */
    public function setSearchParams($sort, $limit, $offset, $staged)
    {
        $this->sort($sort)->limit($limit)->offset($offset)->staged($staged);
    }

    /**
     * @return string
     */
    abstract protected function getProjectionAction();

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getProjectionAction() . '?' . $this->getParamString();
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
