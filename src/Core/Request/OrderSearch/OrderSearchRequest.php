<?php

namespace Commercetools\Core\Request\OrderSearch;

use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\JsonRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderSearch\Hit;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\Orders\OrdersEndpoint;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\PagedSearchResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\MapperInterface;
use stdClass;

/**
 * @package Commercetools\Core\Request\OrderSearch
 * @link https://https://docs.commercetools.com/api/projects/order-search
 * @method PagedSearchResponse executeWithClient(Client $client, array $headers = null)
 * @method Hit mapResponse(ApiResponseInterface $response)
 * @method Hit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderSearchRequest extends AbstractApiRequest
{
    protected $resultClass = Hit::class;

    const SEARCH_QUERY = 'query';
    const SEARCH_SORT = 'sort';
    const SEARCH_LIMIT = 'limit';
    const SEARCH_OFFSET = 'offset';

    /**
     * @var stdClass
     */
    protected $query;

    /**
     * @var string
     */
    protected $sort;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(OrdersEndpoint::endpoint(), $context);
    }

    /**
     * @return stdClass
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param stdClass $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param stdClass $query
     * @param Context $context
     * @return OrderSearchRequest
     */
    public static function ofQuery($query, Context $context = null)
    {
        $request = new static($context);
        $request->setQuery($query);

        return $request;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/search' . $this->getParamString();
    }

    /**
     * @param ResponseInterface $response
     * @return PagedSearchResponse
     * @internal
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new PagedSearchResponse($response, $this, $this->getContext());
    }

    /**
     * @return JsonRequest
     * @internal
     */
    public function httpRequest()
    {
        $payload = [
            static::SEARCH_QUERY => $this->getQuery(),
            static::SEARCH_LIMIT => $this->getLimit(),
            static::SEARCH_SORT => $this->getSort(),
            static::SEARCH_OFFSET => $this->getOffset()
        ];

        return new JsonRequest(HttpMethod::POST, $this->getPath(), $payload);
    }
}
