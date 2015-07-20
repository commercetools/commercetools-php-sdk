<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 11:26
 */

namespace Sphere\Core\Request\Products;

use Psr\Http\Message\ResponseInterface;
use Sphere\Core\Client;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjectionCollection;
use Sphere\Core\Request\AbstractProjectionRequest;
use Sphere\Core\Request\PageTrait;
use Sphere\Core\Request\SortTrait;
use Sphere\Core\Response\ApiResponseInterface;
use Sphere\Core\Response\PagedSearchResponse;
use Sphere\Core\Model\Product\Search\FilterInterface;

/**
 * Class ProductProjectionSearchRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products-search.html#product-projections-by-search
 * @method PagedSearchResponse executeWithClient(Client $client)
 * @method ProductProjectionCollection mapResponse(ApiResponseInterface $response)
 */
class ProductProjectionSearchRequest extends AbstractProjectionRequest
{
    const FACET = 'facet';
    const FILTER = 'filter';
    const FILTER_QUERY = 'filter.query';
    const FILTER_FACETS = 'filter.facets';

    use PageTrait;
    use SortTrait;

    protected $resultClass = '\Sphere\Core\Model\Product\ProductProjectionCollection';

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
     * @return ProductProjectionCollection
     */
    public function mapResult(array $result, Context $context = null)
    {
        $data = [];
        if (!empty($result['results'])) {
            $data = $result['results'];
        }
        return ProductProjectionCollection::fromArray($data, $context);
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
}
