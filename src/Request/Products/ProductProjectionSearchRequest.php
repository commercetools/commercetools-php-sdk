<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\JsonObjectMapper;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Request\ExpandTrait;
use Commercetools\Core\Request\PriceSelectTrait;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\SortRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\Request\AbstractProjectionRequest;
use Commercetools\Core\Request\PageTrait;
use Commercetools\Core\Request\SortTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Response\PagedSearchResponse;
use Commercetools\Core\Model\Product\Search\FilterInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://dev.commercetools.com/http-api-projects-products-search.html#search-productprojections
 * @method PagedSearchResponse executeWithClient(Client $client)
 * @method ProductProjectionCollection mapResponse(ApiResponseInterface $response)
 * @method ProductProjectionCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductProjectionSearchRequest extends AbstractProjectionRequest implements SortRequestInterface
{
    const FACET = 'facet';
    const FILTER = 'filter';
    const FILTER_QUERY = 'filter.query';
    const FILTER_FACETS = 'filter.facets';

    use ExpandTrait;
    use PageTrait;
    use SortTrait;
    use PriceSelectTrait;

    protected $resultClass = ProductProjectionCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }

    /**
     * @return string
     */
    protected function getProjectionAction()
    {
        return 'search';
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
     * @param array $result
     * @param Context $context
     * @param MapperInterface $mapper
     * @return Collection
     */
    public function map(array $result, Context $context = null, MapperInterface $mapper = null)
    {
        $data = [];
        if (!empty($result['results'])) {
            $data = $result['results'];
        }
        if (is_null($mapper)) {
            $mapper = JsonObjectMapper::of($context);
        }
        return $mapper->map($data, $this->resultClass);
    }

    /**
     * @param string $type
     * @param FilterInterface $filter
     * @param bool $replace
     * @return $this
     */
    protected function filter($type, FilterInterface $filter, $replace = false)
    {
        return $this->addParam($type, $filter, $replace);
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFilter(FilterInterface $filter)
    {
        return $this->filter(static::FILTER, $filter);
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFilterQuery(FilterInterface $filter)
    {
        return $this->filter(static::FILTER_QUERY, $filter);
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFilterFacets(FilterInterface $filter)
    {
        return $this->filter(static::FILTER_FACETS, $filter);
    }

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFacet(FilterInterface $filter)
    {
        return $this->filter(static::FACET, $filter);
    }

    /**
     * @param bool|int $level
     * @return $this
     */
    public function fuzzy($level)
    {
        if (!is_bool($level)) {
            $level = min(2, max(0, (int)$level));
        }
        $fuzzy = (bool)$level;
        $this->addParamObject(new Parameter('fuzzy', $fuzzy));

        if (!is_bool($level) && $fuzzy) {
            $this->addParamObject(new Parameter('fuzzyLevel', $level));
        }

        return $this;
    }

    /**
     * @param $mark
     * @return $this
     */
    public function markMatchingVariants($mark)
    {
        $this->addParamObject(new Parameter('markMatchingVariants', $mark));
        
        return $this;
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getProjectionAction();
    }

    /**
     * @return Client\HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        $body = $this->convertToString($this->params);
        return new HttpRequest(HttpMethod::POST, $this->getPath(), $body, 'application/x-www-form-urlencoded');
    }
}
